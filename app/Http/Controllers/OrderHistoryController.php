<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function index()   //تاریخچه‌ی سفارش‌ها
    {
        $orders = Order::where('user_id', Auth::id())
            ->with('orderItems.product.images')
            ->latest()
            ->get();

        return view('shop.orders', compact('orders'));
    }
}
