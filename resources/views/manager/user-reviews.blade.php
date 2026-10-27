@extends('layouts.manager')

@section('content')

    <h1 class="mb-4">نظرات کاربر {{ $user->id }}</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-striped align-middle mb-0">
                <thead class="table-dark">
                <tr>
                    <th>محصول</th>
                    <th>متن نظر</th>
                    <th>امتیاز</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($reviews as $review)
                    <tr>
                        <td>{{ $review->product->name }}</td>
                        <td>{{ $review->comment }}</td>
                        <td>{{ $review->rating }} ⭐</td>
                        <td>
                            <form method="POST" action="{{ url('/manager/reviews/'.$review->id.'/delete-comment') }}" style="display:inline;">
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
