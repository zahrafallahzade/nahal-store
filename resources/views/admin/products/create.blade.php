@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">افزودن محصول جدید</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/products') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="fw-bold">نام محصول</label>
                    <input type="text" name="name" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">دسته‌بندی</label>
                    <select name="category_id" class="form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">توضیحات</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">قیمت</label>
                    <input type="number" name="price" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">موجودی</label>
                    <input type="number" name="stock" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="fw-bold">عکس محصول</label>
                    <input type="file" name="images[]" multiple class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">ثبت محصول</button>
            </form>
        </div>
    </div>

@endsection
