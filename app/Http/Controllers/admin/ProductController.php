<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;

class ProductController extends Controller{

    public function index(Request $request){   //فهرست و جستجوی محصولات

        $categories = Category::all();

        $products = Product::with(['category', 'images'])
            ->when($request->search, fn($q) => $q->where('name', 'like', '%'.$request->search.'%'))   //عبارت وارد شده توی کادر جستجو
            ->when($request->category_id, fn($q) => $q->where('category_id', $request->category_id))   //فیلتر براساس دسته بندی
            ->latest()->get();

        return view('admin.products', compact('products', 'categories'));
    }

    public function edit($id){   //صفحه ویرایش

        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function store(Request $request)   //ثبت محصول جدید
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'is_active' => true,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/products'), $filename);
                $product->images()->create(['image' => 'images/products/'.$filename]);
            }
        }

        return redirect('/admin/products')->with('success', 'محصول با موفقیت اضافه شد.');
    }

    public function update(Request $request, $id){    //ویرایش محصول و ذخیره تغییرات

        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
        ]);

        $product = Product::findOrFail($id);
        $product->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $image) {
                $filename = time().'_'.$image->getClientOriginalName();
                $image->move(public_path('images/products'), $filename);
                $product->images()->create(['image' => 'images/products/'.$filename]);
            }
        }

        return redirect('/admin/products')->with('success', 'محصول ویرایش شد.');
    }

    public function destroy($id){    //غیر فعال کردن محصول

        $product = Product::findOrFail($id);
        $product->update(['is_active' => false]);
        return redirect('/admin/products')->with('success', 'محصول غیرفعال شد.');
    }

    public function deleteImage($id){

        ProductImage::findOrFail($id)->delete();
        return back()->with('success', 'عکس حذف شد.');
    }

    public function activate($id){  //فعال کردن محصول

        $product = Product::findOrFail($id);
        $product->update(['is_active' => true]);
        return redirect('/admin/products')->with('success', 'محصول دوباره فعال شد.');
    }
}
