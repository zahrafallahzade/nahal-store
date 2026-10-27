<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت/ادمین فروشگاه نهال</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>
<div class="d-flex" style="min-height: 100vh;">

    <aside class="text-white p-3" style="width: 240px; min-width: 240px; position: sticky; top: 0; height: 100vh; background-color: #1e293b;">
        <h4 class="mb-4">پنل مدیریت ادمین</h4>
        <ul class="list-unstyled">
            <li class="mb-2"><a href="{{ url('/admin/dashboard') }}" class="text-white text-decoration-none"><i class="bi bi-speedometer2"></i> داشبورد</a></li>
            <li class="mb-2"><a href="{{ url('/admin/products') }}" class="text-white text-decoration-none"><i class="bi bi-box-seam"></i> محصولات</a></li>
            <li class="mb-2"><a href="{{ url('/admin/categories') }}" class="text-white text-decoration-none"><i class="bi bi-tags"></i> دسته بندی</a></li>
            <li class="mb-2"><a href="{{ url('/admin/orders') }}" class="text-white text-decoration-none"><i class="bi bi-cart"></i> سفارش ها</a></li>
            <li class="mb-2"><a href="{{ url('/admin/users') }}" class="text-white text-decoration-none"><i class="bi bi-people"></i> کاربران</a></li>
            <li class="mb-2"><a href="{{ url('/admin/reviews') }}" class="text-white text-decoration-none"><i class="bi bi-chat-dots"></i> نظرات</a></li>
            <li class="mb-2"><a href="{{ url('/admin/account') }}" class="text-white text-decoration-none"><i class="bi bi-gear"></i> تنظیمات حساب</a></li>
        </ul>
    </aside>

    <main class="flex-grow-1 p-4" style="background-color: #f8f9fa; min-height: 100vh;">
        @yield('content')
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
