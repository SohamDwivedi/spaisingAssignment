<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class CartController extends Controller
{
    /** GET /api/cart */
    public function index(Request $request)
    {
        $items = CartItem::with('product')
            ->where('user_id', $request->user()->id)
            ->get();

        return response()->json(['cart' => $items]);
    }

    /** POST /api/cart (add item) */
    public function store(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1'
        ]);

        $userId = $request->user()->id;

        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $data['product_id'])
            ->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $data['quantity']);
        } else {
            $cartItem = CartItem::create([
                'user_id'    => $userId,
                'product_id' => $data['product_id'],
                'quantity'   => $data['quantity'],
            ]);
        }

        return response()->json(['message' => 'Item added to cart', 'cart_item' => $cartItem]);
    }

    /** PATCH /api/cart/items/{productId} */
    public function update(Request $request, $productId)
    {
        $data = $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem = CartItem::where('user_id', $request->user()->id)
            ->where('product_id', $productId)
            ->firstOrFail();

        $cartItem->update(['quantity' => $data['quantity']]);

        return response()->json(['message' => 'Quantity updated', 'cart_item' => $cartItem]);
    }

    /** DELETE /api/cart/items/{productId} */
    public function destroy(Request $request, $productId)
    {
        $cartItem = CartItem::where('user_id', $request->user()->id)
        ->where('product_id', $productId)
        ->first();

        if (!$cartItem) {
            return response()->json(['error' => 'Item not found in cart'], 200);
        }

        
        $cartItem->delete();
        $message = 'Item removed from cart';
        

        return response()->json(['message' => $message, 'cart_item' => $cartItem]);
    }

    /** POST /api/checkout */
    public function checkout(Request $request)
    {
        $user = $request->user();

        $cartItems = CartItem::with('product')
            ->where('user_id', $user->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['error' => 'Cart is empty'], 400);
        }

        DB::beginTransaction();
        try {
            $total = 0;

            foreach ($cartItems as $item) {
                if ($item->quantity > $item->product->stock) {
                    throw new \Exception("Insufficient stock for {$item->product->name}");
                }

                $total += $item->quantity * $item->product->price;
            }

            $order = Order::create([
                'user_id' => $user->id,
                'total'   => $total,
                'status'  => 'completed',
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->product->price,
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            CartItem::where('user_id', $user->id)->delete();

            \Mail::to($user->email)->send(new \App\Mail\OrderConfirmationMail($order));

            DB::commit();
            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
