<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    /**
     * GET /api/admin/orders
     * List all orders with user + items + pagination
     */
    public function index(Request $request)
    {
        $orders = Order::with(['user', 'items.product'])
            ->latest()
            ->paginate(5);

        return response()->json([
            'data' => OrderResource::collection($orders),
            'meta' => [
                'current_page' => $orders->currentPage(),
                'last_page' => $orders->lastPage(),
                'per_page' => $orders->perPage(),
                'total' => $orders->total(),
                'next_page_url' => $orders->nextPageUrl(),
                'prev_page_url' => $orders->previousPageUrl(),
            ]
        ]);
    }

    /**
     * GET /api/admin/orders/{id}
     * Show details of one order (any user)
     */
    public function show($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);

        return new OrderResource($order);
    }
}
