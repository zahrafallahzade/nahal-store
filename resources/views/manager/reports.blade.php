@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">گزارش‌های مالی و فروش</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>دسته‌بندی</th>
                    <th>تعداد کل فروخته‌شده</th>
                    <th>جمع درآمد</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->total_qty }}</td>
                        <td>{{ number_format($category->total_revenue) }} تومان</td>
                        <td>
                            <a href="{{ url('/manager/reports/'.$category->id) }}" class="btn btn-sm btn-outline-primary">مشاهده جزئیات</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
