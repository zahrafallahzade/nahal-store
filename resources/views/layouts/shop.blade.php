<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه نهال</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
</head>

<body>

<nav class="navbar navbar-expand-lg" style="background-color: #16a34a;">
    <div class="container">

        <a href="{{ url('/cart') }}" class="btn text-white fs-4 border-0">
            <i class="bi bi-cart"></i>
        </a>

        <button class="btn text-white fs-4 border-0" data-bs-toggle="offcanvas" data-bs-target="#sideMenu">
            <i class="bi bi-list"></i>
        </button>

        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="{{ asset('images/logo.png') }}" alt="نهال" height="40">
        </a>

        <form class="d-flex flex-grow-1 mx-4" method="GET" action="{{ url('/products') }}">
            <input type="text" name="search" class="form-control" placeholder="جست‌وجوی محصول">
        </form>

        <div>
            @if(auth()->check())
                <a href="{{ url('/profile') }}" class="text-white text-decoration-none me-2">
                    {{ auth()->user()->username }}
                </a>
            @else
                <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">ورود / ثبت‌نام</a>
            @endif
        </div>

    </div>
</nav>

<main class="container my-4">
    @yield('content')
</main>

<footer class="text-center text-muted py-4 border-top">
    <p>© فروشگاه نهال — پروژه دانشگاهی</p>
</footer>

<div class="offcanvas offcanvas-start" tabindex="-1" id="sideMenu" style="width: 250px; background-color: #7fff83;">
    <div class="offcanvas-header">
        <h5>منو</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="list-unstyled">
            <li class="mb-3"><a href="{{ url('/profile') }}" class="text-dark text-decoration-none"><i class="bi bi-person"></i> حساب کاربری</a></li>
            <li class="mb-3"><a href="{{ url('/orders') }}" class="text-dark text-decoration-none"><i class="bi bi-box-seam"></i> سفارش‌های من</a></li>
            <li class="mb-3"><a href="{{ url('/about') }}" class="text-dark text-decoration-none"><i class="bi bi-info-circle"></i> درباره ما</a></li>
            <li class="mb-3"><a href="{{ url('/contact') }}" class="text-dark text-decoration-none"><i class="bi bi-telephone"></i> تماس با ما</a></li>
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

@if(session('success') || session('error'))
    <div class="toast-container position-fixed top-0 end-0 p-3">
        <div class="toast align-items-center text-white {{ session('success') ? 'bg-success' : 'bg-danger' }} border-0" role="alert" id="liveToast">
            <div class="d-flex">
                <div class="toast-body">
                    {{ session('success') ?? session('error') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <script>
        var toastEl = document.getElementById('liveToast');
        var toast = new bootstrap.Toast(toastEl, { delay: 5000 });
        toast.show();
    </script>
@endif

</body>
</html>
