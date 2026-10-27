@extends('layouts.shop')

@section('content')

    <h3 class="mb-4">سفارش‌های من</h3>

    @forelse ($orders as $order)
        <div class="card mb-3">
            <div class="card-header">
                @switch($order->status)
                    @case('pending') <span class="badge bg-warning">در انتظار</span> @break
                    @case('processing') <span class="badge bg-info">در حال پردازش</span> @break
                    @case('shipped') <span class="badge bg-primary">ارسال شده</span> @break
                    @case('delivered') <span class="badge bg-success">تحویل داده شده</span> @break
                    @case('cancelled') <span class="badge bg-danger">لغو شده</span> @break
                @endswitch
            </div>
            <div class="card-body">
                <table class="table table-sm mb-2">
                    <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td style="width: 60px;">
                                @if($item->product->images->first())
                                    <img src="{{ asset($item->product->images->first()->image) }}" width="50">
                                @endif
                            </td>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }} عدد</td>
                            <td>{{ number_format($item->quantity * $item->product->price) }} تومان</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <p class="text-end fw-bold mb-0">
                    جمع کل:
                    {{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->product->price)) }}
                    تومان
                </p>
            </div>
        </div>
    @empty
        <p class="text-muted">هنوز سفارشی ثبت نکرده‌اید.</p>
    @endforelse

@endsection
