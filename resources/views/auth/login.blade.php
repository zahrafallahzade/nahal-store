<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به فروشگاه نهال</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.rtl.min.css">
</head>

<body style="background-color: #f8f9fa;">
<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm" style="width: 400px;">
        <div class="card-body p-4">
            <h3 class="text-center mb-4">ورود به فروشگاه نهال</h3>

            <form method="POST" action="{{ url('/login') }}">
                @csrf

                <div class="mb-3">
                    <label class="fw-bold">شماره موبایل</label>
                    <input type="text" name="phone" class="form-control value="{{ old('phone') }}">
                    @error('phone')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fw-bold">رمز عبور</label>
                    <input type="password" name="password" class="form-control">
                    @error('password')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror

                    @error('login')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">ورود</button>

                <p class="text-center mt-3">
                    حساب ندارید؟ <a href="{{ url('/register') }}">ثبت‌نام کنید</a>
                </p>
            </form>
        </div>
    </div>
</div>

</body>
</html>
