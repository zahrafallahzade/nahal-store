@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">ویرایش محصول</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/products/'.$product->id.'/update') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="fw-bold">نام محصول</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">دسته‌بندی</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">توضیحات</label>
                    <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">قیمت</label>
                    <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">موجودی</label>
                    <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">عکس‌های فعلی</label>
                    <div class="d-flex gap-2 flex-wrap">
                        @foreach($product->images as $image)
                            <div class="text-center">
                                <img src="{{ asset($image->image) }}" width="80" height="80" style="object-fit: cover;" class="rounded">
                                <div>
                                    <a href="#" class="btn btn-sm btn-outline-danger mt-1" onclick="event.preventDefault(); document.getElementById('delete-image-{{ $image->id }}').submit();">حذف</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">افزودن عکس جدید</label>
                    <input type="file" name="new_images[]" multiple class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
            </form>
        </div>
    </div>

    @foreach($product->images as $image)
        <form id="delete-image-{{ $image->id }}" method="POST" action="{{ url('/admin/products/images/'.$image->id.'/delete') }}" style="display:none;">
            @csrf
        </form>
    @endforeach

@endsection
