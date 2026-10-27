<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRevenue = Order::where('status', 'delivered')->sum('total_price');   //محاسبه درآمد سفارش‌های تحویل‌شده
        $deliveredCount = Order::where('status', 'delivered')->count();
        $customersCount = User::where('role', 'user')->count();
        $atRiskUsers = User::where('bad_reviews_count', '>=', 3)->count();

        $categories = Category::all()->map(function ($category) {
            $items = OrderItem::whereHas('product', fn($q) => $q->where('category_id', $category->id))->with('product')->get();    //پیدا کردن محصولاتی که مربوط به دسته بندی فعلی میشوند
            $category->total_qty = $items->sum('quantity');
            return $category;
        });

        return view('manager.dashboard', compact('totalRevenue', 'deliveredCount', 'customersCount', 'atRiskUsers', 'categories'));
    }
}
