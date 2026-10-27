<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller{

    public function index(){    //نمایش دسته بندی ها

        $categories = Category::withCount('products')->get();
        return view('admin.categories', compact('categories'));
    }

    public function edit($id){    //باز کردن فرم ویرایش

        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function store(Request $request)    //افزودن دسته بندی جدید
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect('/admin/categories')->with('success', 'دسته‌بندی اضافه شد.');
    }

    public function update(Request $request, $id)    //ویرایش دسته بندی
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $category = Category::findOrFail($id);
        $category->update([
            'name' => $request->name,
        ]);

        return redirect('/admin/categories')->with('success', 'دسته‌بندی ویرایش شد.');
    }

    public function destroy($id)   //حذف دسته بندی
    {
        $category = Category::findOrFail($id);

        if ($category->products()->count() > 0) {
            return back()->with('error', 'این دسته‌بندی محصول دارد و قابل حذف نیست.');
        }

        $category->delete();
        return redirect('/admin/categories')->with('success', 'دسته‌بندی حذف شد.');
    }
}
