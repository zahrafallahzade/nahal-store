<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\OrderItem;

class ReportController extends Controller
{
    public function index()    //گزارش کلی دسته بندی ها
    {
        $categories = Category::all()->map(function ($category) {
            $items = OrderItem::whereHas('product', fn($q) => $q->where('category_id', $category->id))->with('product')->get();

            $category->total_qty = $items->sum('quantity');
            $category->total_revenue = $items->sum(fn($item) => $item->quantity * $item->product->price);

            return $category;
        });

        return view('manager.reports', compact('categories'));
    }

    public function show($id)    //گزارش یک دسته بندی مشخص
    {
        $category = Category::findOrFail($id);

        $items = OrderItem::whereHas('product', fn($q) => $q->where('category_id', $id))
            ->with('product')
            ->get()
            ->groupBy('product_id');

        $products = $items->map(function ($group) {
            $product = $group->first()->product;
            return [
                'name' => $product->name,
                'qty' => $group->sum('quantity'),
                'revenue' => $group->sum(fn($item) => $item->quantity * $product->price),
            ];
        });

        return view('manager.report-detail', compact('category', 'products'));
    }
}
