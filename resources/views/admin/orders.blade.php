@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">سفارش‌ها</h1>

    <form method="POST" action="{{ url('/admin/orders/bulk-update') }}">
        @csrf
        <div id="bulkBar" class="mb-3">
            <select name="status" class="form-select d-inline-block w-auto">
            <option value="pending">در انتظار</option>
            <option value="processing">در حال پردازش</option>
            <option value="shipped">ارسال شده</option>
            <option value="delivered">تحویل داده شده</option>
            <option value="cancelled">لغو شده</option>
        </select>
            <button type="submit" class="btn btn-primary">اعمال تغییر</button>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" id="checkAll"></th>
                    <th>شماره سفارش</th>
                    <th>خریدار</th>
                    <th>مبلغ کل</th>
                    <th>وضعیت</th>
                    <th>تاریخ ثبت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="rowCheck"></td>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                        <td>{{ number_format($order->orderItems->sum(fn($item) => $item->quantity * $item->product->price) + $order->shipping_cost) }} تومان</td>
                        <td>
                            @switch($order->status)
                                @case('pending') <span class="text-warning">در انتظار</span> @break
                                @case('processing') <span class="text-info">در حال پردازش</span> @break
                                @case('shipped') <span class="text-primary">ارسال شده</span> @break
                            @endswitch
                        </td>
                        <td>{{ $order->ordered_at }}</td>
                        <td>
                            <a href="{{ url('/admin/orders/'.$order->id) }}" class="btn btn-sm btn-outline-primary">جزئیات</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </form>
    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            document.querySelectorAll('.rowCheck').forEach(cb => cb.checked = this.checked);
        });
    </script>

@endsection
