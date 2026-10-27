@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">جزئیات فروش: {{ $category->name }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>نام محصول</th>
                    <th>تعداد فروخته‌شده</th>
                    <th>جمع درآمد</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['qty'] }}</td>
                        <td>{{ number_format($product['revenue']) }} تومان</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
