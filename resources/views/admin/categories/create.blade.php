@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">افزودن دسته‌بندی</h1>
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ url('/admin/categories') }}">
                @csrf
                <div class="mb-3">
                    <label class="fw-bold">نام دسته‌بندی</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">ثبت</button>
            </form>
        </div>
    </div>
@endsection
