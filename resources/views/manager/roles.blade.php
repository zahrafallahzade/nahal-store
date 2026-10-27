@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">مدیریت نقش‌ها و دسترسی‌ها</h1>

    <form method="GET" class="mb-4">
        <select name="role" class="form-select w-auto d-inline-block" onchange="this.form.submit()">
            <option value="">همه نقش‌ها</option>
            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>کاربر</option>
            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>ادمین</option>
            <option value="manager" {{ request('role') == 'manager' ? 'selected' : '' }}>مدیر</option>
        </select>
    </form>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>شناسه</th>
                    <th>نام و نام‌خانوادگی</th>
                    <th>نقش فعلی</th>
                    <th>تغییر نقش</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>
                            @switch($user->role)
                                @case('user') <span class="badge bg-secondary">کاربر</span> @break
                                @case('admin') <span class="badge bg-primary">ادمین</span> @break
                                @case('manager') <span class="badge bg-success">مدیر</span> @break
                            @endswitch
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/manager/roles/'.$user->id.'/update') }}" class="d-flex gap-2">
                                @csrf
                                <select name="role" class="form-select form-select-sm">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>کاربر</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>ادمین</option>
                                    <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>مدیر</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-outline-primary">اعمال</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
