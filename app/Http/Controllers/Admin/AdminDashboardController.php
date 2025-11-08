<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class AdminDashboardController extends Controller
{
    /**
     * GET /api/admin/dashboard
     * Returns totals: users, products, revenue
     */
    public function index()
    {
        $totals = [
            'total_users'    => User::count(),
            'total_products' => Product::count(),
            'total_revenue'  => Order::sum('total'),
        ];

        return response()->json($totals);
    }
}
