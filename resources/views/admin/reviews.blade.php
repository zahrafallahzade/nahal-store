@extends('layouts.admin')

@section('content')

    <h1 class="mb-4">نظرات</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>کاربر</th>
                    <th>محصول</th>
                    <th>متن نظر</th>
                    <th>امتیاز</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->user->id }}</td>
                        <td>{{ $review->product->name }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->rating }} ⭐</td>
                        <td>
                            @if($review->is_approved)
                                <span class="text-success">تایید شده</span>
                            @else
                                <span class="text-warning">در انتظار</span>
                            @endif
                        </td>
                        <td>
                            <form method="POST" action="{{ url('/admin/reviews/'.$review->id.'/approve') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-success">تایید</button>
                            </form>
                            <form method="POST" action="{{ url('/admin/reviews/'.$review->id.'/flag') }}" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger">فحش‌دار / مخفی</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
