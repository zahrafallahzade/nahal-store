@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">محصولات</h1>
        <a href="{{ url('/admin/products/create') }}" class="btn btn-primary">
            + افزودن محصول جدید
        </a>
    </div>

    <form method="GET" class="row mb-4">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="جست‌وجوی نام محصول" value="{{ request('search') }}">
        </div>
        <div class="col-auto">
            <select name="category_id" class="form-select">
                <option value="">همه دسته‌بندی‌ها</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-auto">
            <button class="btn btn-primary">جست‌وجو</button>
        </div>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>عکس</th>
                    <th>نام محصول</th>
                    <th>قیمت</th>
                    <th>موجودی</th>
                    <th>دسته‌بندی</th>
                    <th>عملیات</th>
                </tr>
                </thead>

                <tbody>
                @foreach ($products as $product)
                    <tr class="{{ !$product->is_active ? 'table-secondary' : '' }}">
                        <td>
                            @if($product->images->first())
                                <img src="{{ asset($product->images->first()->image) }}" width="50">
                            @endif
                        </td>
                        <td>
                            {{ $product->name }}
                            @if(!$product->is_active)
                                <span class="badge bg-secondary">غیرفعال</span>
                            @endif
                        </td>
                        <td>{{ number_format($product->price) }} تومان</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            @if($product->is_active)
                                <a href="{{ url('/admin/products/'.$product->id.'/edit') }}" class="btn btn-sm btn-outline-primary">ویرایش</a>
                                <form method="POST" action="{{ url('/admin/products/'.$product->id.'/delete') }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                                </form>
                            @else
                                <form method="POST" action="{{ url('/admin/products/'.$product->id.'/activate') }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-success">فعال‌سازی</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
