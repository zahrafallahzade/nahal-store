@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">کاربران</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>شناسه کاربر</th>
                    <th>تعداد نظرات نامناسب</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td class="{{ $user->bad_reviews_count >= 3 ? 'text-danger fw-bold' : '' }}">
                            {{ $user->bad_reviews_count }}
                        </td>
                        <td>
                            @if($user->is_banned)
                                <span class="text-danger">مسدود</span>
                            @else
                                <span class="text-success">فعال</span>
                            @endif
                        </td>
                        <td>
                            @if($user->is_banned)
                                <span class="badge bg-danger">مسدود شده</span>
                            @else
                                <form method="POST" action="{{ url('/admin/users/'.$user->id.'/ban') }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger" {{ $user->bad_reviews_count < 3 ? 'disabled' : '' }}>
                                        مسدود کردن
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
