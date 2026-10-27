@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">کاربران و نظرات</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>شناسه</th>
                    <th>تعداد کل نظرات</th>
                    <th>تعداد نظرات منفی</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->reviews_count }}</td>
                        <td class="{{ $user->bad_reviews_count >= 3 ? 'text-danger fw-bold' : '' }}">{{ $user->bad_reviews_count }}</td>
                        <td>
                            <a href="{{ url('/manager/users/'.$user->id.'/reviews') }}" class="btn btn-sm btn-outline-primary">مشاهده نظرات</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
