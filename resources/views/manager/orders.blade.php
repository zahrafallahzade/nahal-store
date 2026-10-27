@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">سفارش‌ها</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>شماره سفارش</th>
                    <th>خریدار</th>
                    <th>مبلغ کل</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td>{{ number_format($order->total_price) }} تومان</td>
                        <td>
                            @switch($order->status)
                                @case('pending') <span class="text-warning">در انتظار</span> @break
                                @case('processing') <span class="text-info">در حال پردازش</span> @break
                                @case('shipped') <span class="text-primary">ارسال شده</span> @break
                                @case('delivered') <span class="text-success">تحویل داده شده</span> @break
                                @case('cancelled') <span class="text-danger">لغو شده</span> @break
                            @endswitch
                        </td>
                        <td>{{ $order->ordered_at }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
