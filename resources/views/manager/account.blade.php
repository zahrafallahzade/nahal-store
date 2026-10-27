@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">تنظیمات حساب</h1>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/manager/account/update') }}">
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
                    <label class="fw-bold">شماره تماس</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', auth()->user()->phone) }}">
                </div>

                <hr>
                <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#changePasswordModal">
                    تغییر رمز عبور
                </button>

                <button type="submit" class="btn btn-primary">ذخیره تغییرات</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="changePasswordModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">تغییر رمز عبور</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ url('/manager/account/password') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-bold">رمز عبور فعلی</label>
                            <div class="input-group">
                                <input type="password" name="old_password" class="form-control" id="oldPassword">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('oldPassword', this)">👁</button>
                            </div>
                            @error('old_password')
                            <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">رمز عبور جدید</label>
                            <div class="input-group">
                                <input type="password" name="new_password" class="form-control" id="newPassword">
                                <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('newPassword', this)">👁</button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">ثبت رمز جدید</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(fieldId, btn) {
            const field = document.getElementById(fieldId);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>

@endsection
