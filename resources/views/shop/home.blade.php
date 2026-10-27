@extends('layouts.shop')

@section('content')

    <div class="p-5 mb-4 rounded-3 text-center text-white position-relative overflow-hidden" style="background-image: url('{{ asset('images/banner.jpg') }}'); background-size: cover; background-position: center 80%;">
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background-color: rgba(0,0,0,0.4);"></div>
        <div class="position-relative">
            <h2>به فروشگاه نهال خوش آمدید</h2>
            <p>بهترین پازل‌ها و بازی‌های فکری، اینجا پیدا می‌کنید</p>
            <a href="{{ url('/products') }}" class="btn btn-light">مشاهده همه محصولات</a>
        </div>
    </div>

    <h4 class="mb-3">جدیدترین محصولات</h4>

    <div class="row row-cols-1 row-cols-md-4 g-4 mb-4">
        @foreach ($newProducts as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->images->first())
                        <img src="{{ asset($product->images->first()->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="fw-bold">{{ number_format($product->price) }} تومان</p>
                        <a href="{{ url('/products/'.$product->id) }}" class="btn btn-outline-success btn-sm w-100">مشاهده محصول</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <h4 class="mb-3">پرفروش‌ترین محصولات</h4>

    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($bestSellers as $product)
            <div class="col">
                <div class="card h-100 shadow-sm">
                    @if($product->images->first())
                        <img src="{{ asset($product->images->first()->image) }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="fw-bold">{{ number_format($product->price) }} تومان</p>
                        <a href="{{ url('/products/'.$product->id) }}" class="btn btn-outline-success btn-sm w-100">مشاهده محصول</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

@endsection
