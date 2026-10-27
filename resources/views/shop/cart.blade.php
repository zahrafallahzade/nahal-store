@extends('layouts.shop')

@section('content')

    <h3 class="mb-4">سبد خرید</h3>

    <div class="card mb-3">
        <div class="card-body">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>محصول</th>
                    <th>تعداد</th>
                    <th>قیمت</th>
                </tr>
                </thead>
                <tbody>
                @forelse($cartItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->quantity * $item->product->price) }} تومان</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">سبد خرید شما خالی است.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if($cartItems->count() > 0)
        <div class="card mb-3">
            <div class="card-body">
                <h6>آدرس ارسال</h6>
                <p class="mb-0 text-muted">
                    {{ auth()->user()->address->province ?? '' }}،
                    {{ auth()->user()->address->city ?? '' }}،
                    {{ auth()->user()->address->address ?? '' }}
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="mb-1">هزینه ارسال: {{ number_format($shippingCost) }} تومان</p>
                    <h5 class="mb-0">مبلغ قابل پرداخت: {{ number_format($total) }} تومان</h5>
                </div>
                <form method="POST" action="{{ url('/checkout') }}">
                    @csrf
                    <button type="submit" class="btn btn-success btn-lg">
                        پرداخت
                    </button>
                </form>
            </div>
        </div>
    @endif

@endsection
