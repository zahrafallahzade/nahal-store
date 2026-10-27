<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductListController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->where('is_active', true)
            ->when($request->search, fn($q) => $q->where('name', 'like', '%'.$request->search.'%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->latest()
            ->get();

        return view('shop.products', compact('products', 'categories'));
    }

    public function show($id)    //نمایش نظرات تایید شده
    {
        $product = Product::with(['category', 'images'])
            ->withAvg('reviews', 'rating')
            ->findOrFail($id);

        $reviews = $product->reviews()->where('is_approved', true)
            ->with('user')->get();

        return view('shop.product-detail', compact('product', 'reviews'));
    }
}
