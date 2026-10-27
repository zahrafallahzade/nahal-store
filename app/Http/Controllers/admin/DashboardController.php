<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $pendingReviewsCount = Review::where('is_approved', false)->count();
        $lowStockCount = Product::where('stock', '<=', 5)->count();
        $atRiskUsers = User::where('bad_reviews_count', '>=', 3)->count();

        $orderStatuses = Order::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->get();

        return view('admin.dashboard', compact(
            'pendingOrdersCount', 'pendingReviewsCount', 'lowStockCount', 'atRiskUsers', 'orderStatuses'
        ));
    }
}
