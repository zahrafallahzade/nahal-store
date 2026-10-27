<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $newProducts = Product::with(['category', 'images'])
            ->where('is_active', true)
            ->latest()
            ->take(4)
            ->get();

        $bestSellers = Product::with(['category', 'images'])
            ->withSum('orderItems', 'quantity')
            ->where('is_active', true)
            ->orderByDesc('order_items_sum_quantity')
            ->take(4)
            ->get();

        return view('shop.home', compact('newProducts', 'bestSellers'));
    }
}
