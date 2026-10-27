@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">محصولات</h1>

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
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            @if($product->images->first())
                                <img src="{{ asset($product->images->first()->image) }}" width="50">
                            @endif
                        </td>
                        <td>{{ $product->name }}</td>
                        <td>{{ number_format($product->price) }} تومان</td>
                        <td>{{ $product->stock }}</td>
                        <td>{{ $product->category->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
