@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">داشبورد ادمین</h1>

    <div class="row mb-4">

        <div class="col">
            <div class="card border-start border-warning border-4">
                <div class="card-body">
                    <i class="bi bi-cart fs-3 text-warning"></i>
                    <p class="text-muted mb-1">سفارش‌های در انتظار</p>
                    <h4>{{ $pendingOrdersCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-info border-4">
                <div class="card-body">
                    <i class="bi bi-chat-dots fs-3 text-info"></i>
                    <p class="text-muted mb-1">نظرات تاییدنشده</p>
                    <h4>{{ $pendingReviewsCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-danger border-4">
                <div class="card-body">
                    <i class="bi bi-exclamation-triangle fs-3 text-danger"></i>
                    <p class="text-muted mb-1">محصولات با موجودی کم</p>
                    <h4>{{ $lowStockCount }}</h4>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card border-start border-danger border-4">
                <div class="card-body">
                    <i class="bi bi-person-x fs-3 text-danger"></i>
                    <p class="text-muted mb-1">کاربران در آستانه مسدودی</p>
                    <h4>{{ $atRiskUsers }}</h4>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-body">
            <h5 class="mb-3">وضعیت سفارش‌ها</h5>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        new Chart(document.getElementById('ordersChart'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($orderStatuses->pluck('status')) !!},
                datasets: [{
                    label: 'تعداد سفارش',
                    data: {!! json_encode($orderStatuses->pluck('total')) !!},
                    backgroundColor: '#0d9488',
                    barPercentage: 0.4
                }]
            }
        });
    </script>

@endsection
