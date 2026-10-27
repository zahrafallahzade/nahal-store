@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">جزئیات سفارش #{{ $order->id }}</h1>

    <div class="card mb-3">
        <div class="card-body">
            <p><strong>خریدار:</strong> {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
            <p><strong>تاریخ ثبت:</strong> {{ $order->ordered_at }}</p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <table class="table table-sm mb-0">
                <thead>
                <tr>
                    <th>محصول</th>
                    <th>تعداد</th>
                    <th>قیمت</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->orderItems as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->quantity * $item->product->price) }} تومان</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p class="mb-1"><strong>مبلغ کالاها:</strong> {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->product->price)) }} تومان</p>
            <p class="mb-1"><strong>هزینه ارسال:</strong> {{ number_format($order->shipping_cost) }} تومان</p>
            <p class="mb-0 fw-bold"><strong>مبلغ کل:</strong> {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->product->price) + $order->shipping_cost) }} تومان</p>
        </div>
    </div>

@endsection
