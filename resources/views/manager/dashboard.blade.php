@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">داشبورد مدیر</h1>

    <div class="row mb-4">
        <div class="col">
            <div class="card border-start border-success border-4">
                <div class="card-body">
                    <i class="bi bi-cash-coin fs-3 text-success"></i>
                    <p class="text-muted mb-1">درآمد کل</p>
                    <h4>{{ number_format($totalRevenue) }} تومان</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-primary border-4">
                <div class="card-body">
                    <i class="bi bi-check-circle fs-3 text-primary"></i>
                    <p class="text-muted mb-1">سفارش‌های تحویل‌داده‌شده</p>
                    <h4>{{ $deliveredCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-info border-4">
                <div class="card-body">
                    <i class="bi bi-people fs-3 text-info"></i>
                    <p class="text-muted mb-1">تعداد مشتریان</p>
                    <h4>{{ $customersCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-danger border-4">
                <div class="card-body">
                    <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    <p class="text-muted mb-1">کاربران در آستانه مسدودی</p>
                    <h4>{{ $atRiskUsers }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="mb-3">فروش بر اساس دسته‌بندی</h5>
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('salesChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($categories->pluck('name')) !!},
                datasets: [{
                    label: 'تعداد فروخته‌شده',
                    data: {!! json_encode($categories->pluck('total_qty')) !!},
                    backgroundColor: '#0d9488',
                    barPercentage: 0.4
                }]
            }
        });
    </script>

@endsection
