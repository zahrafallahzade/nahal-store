<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with(['category', 'images'])
            ->when($request->search, fn($q) => $q->where('name', 'like', '%'.$request->search.'%'))
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))
            ->latest()->get();

        return view('manager.products', compact('products', 'categories'));
    }
}
