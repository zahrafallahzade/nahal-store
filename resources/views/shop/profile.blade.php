@extends('layouts.shop')

@section('content')

    <h3 class="mb-4">حساب کاربری</h3>

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-3">اطلاعات حساب</h5>
            <form method="POST" action="{{ url('/profile/update') }}">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">نام</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', auth()->user()->first_name) }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">نام خانوادگی</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', auth()->user()->last_name) }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">نام کاربری</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', auth()->user()->username) }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">شماره موبایل</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                </div>

                <hr>
                <h5 class="mb-3">آدرس من</h5>

                <div class="mb-3">
                    <label class="fw-bold">استان</label>
                    <input type="text" name="province" class="form-control" value="{{ old('province', auth()->user()->address->province ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">شهر</label>
                    <input type="text" name="city" class="form-control" value="{{ old('city', auth()->user()->address->city ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">آدرس</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', auth()->user()->address->address ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">پلاک</label>
                    <input type="text" name="plaque" class="form-control" value="{{ old('plaque', auth()->user()->address->plaque ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">واحد</label>
                    <input type="text" name="unit" class="form-control" value="{{ old('unit', auth()->user()->address->unit ?? '') }}">
                </div>
                <div class="mb-3">
                    <label class="fw-bold">کد پستی</label>
                    <input type="text" name="postal_code" class="form-control" value="{{ old('postal_code', auth()->user()->address->postal_code ?? '') }}">
                </div>

                <hr>
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    تغییر رمز عبور
                </button>

                <button type="submit" class="btn btn-success">ذخیره تغییرات</button>
            </form>
        </div>
    </div>

    <a href="{{ url('/logout') }}" class="btn btn-outline-danger">خروج از حساب</a>

    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تغییر رمز عبور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/profile/password') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="fw-bold">رمز عبور فعلی</label>
                            <div class="input-group">
                                <input type="password" name="old_password" class="form-control" id="oldPassword">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('oldPassword')">👁</button>
                            </div>
                            @error('old_password')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold">رمز عبور جدید</label>
                            <input type="password" name="new_password" class="form-control">
                            @error('new_password')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">ثبت رمز جدید</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>

@endsection
