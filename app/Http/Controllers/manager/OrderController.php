<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->get();   //نمایش فهرست سفارش ها
        return view('manager.orders', compact('orders'));
    }
}
