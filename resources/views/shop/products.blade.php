@extends('layouts.shop')

@section('content')

    <h2 class="mb-4">محصولات</h2>

    <form method="GET" class="row mb-4">
        <div class="col-auto">
            <input type="text" name="search" class="form-control" placeholder="جست‌وجوی محصول" value="{{ request('search') }}">
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
            <button class="btn btn-success">جست‌وجو</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @forelse ($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->images->first())
                        <img src="{{ asset($product->images->first()->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="text-muted small">{{ $product->category->name }}</p>
                        <p class="fw-bold">{{ number_format($product->price) }} تومان</p>
                        <a href="{{ url('/products/'.$product->id) }}" class="btn btn-outline-success btn-sm w-100">مشاهده محصول</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">محصولی یافت نشد.</p>
        @endforelse
    </div>

@endsection
