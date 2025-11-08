<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;

class OrderController extends Controller
{
    /**
     * GET /api/orders
     * Fetch all orders for the authenticated user
     */
    public function index(Request $request)
    {
        $orders = Order::with(['orderItems.product'])
            ->where('user_id', $request->user()->id)
            ->orderByDesc('created_at')
            ->paginate(10);

        return OrderResource::collection($orders);
    }

    /**
     * GET /api/orders/{id}
     * Fetch a single order belonging to the authenticated user
     */
    public function show(Request $request, $id)
    {
        $order = Order::with(['orderItems.product'])
            ->where('user_id', $request->user()->id)
            ->findOrFail($id);

        return new OrderResource($order);
    }
}
