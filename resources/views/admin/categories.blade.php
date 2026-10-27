@extends('layouts.admin')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">دسته‌بندی</h1>
        <a href="{{ url('/admin/categories/create') }}" class="btn btn-primary">+ افزودن دسته‌بندی</a>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>نام دسته‌بندی</th>
                    <th>تعداد محصولات</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" class="btn btn-sm btn-outline-primary">ویرایش</a>
                            <form method="POST" action="{{ url('/admin/categories/'.$category->id.'/delete') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
