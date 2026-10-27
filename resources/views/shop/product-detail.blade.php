@extends('layouts.shop')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @foreach($product->images as $image)
                <img src="{{ asset($image->image) }}" class="img-fluid mb-2 rounded">
            @endforeach
        </div>

        <div class="col-md-6">
            <h3>{{ $product->name }}</h3>
            <p class="text-warning">
                ⭐ {{ number_format($product->reviews_avg_rating, 1) }} از 5
            </p>
            <p class="text-muted">{{ $product->category->name }}</p>
            <h4 class="text-success">{{ number_format($product->price) }} تومان</h4>

            <h6 class="mt-3">توضیحات</h6>
            <p>{{ $product->description }}</p>

            @if($product->stock > 0)
                <form method="POST" action="{{ url('/cart/add/'.$product->id) }}">
                    @csrf
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty(-1)">−</button>
                        <input type="text" name="quantity" id="qtyInput" value="1" class="form-control text-center" style="width: 60px;" readonly>
                        <button type="button" class="btn btn-outline-secondary" onclick="changeQty(1)">+</button>
                    </div>

                    <button type="submit" class="btn btn-success">افزودن به سبد خرید</button>
                </form>

                <script>
                    function changeQty(amount) {
                        const input = document.getElementById('qtyInput');
                        let value = parseInt(input.value) + amount;
                        if (value < 1) value = 1;
                        input.value = value;
                    }
                </script>
            @else
                <button class="btn btn-secondary" disabled>ناموجود</button>
            @endif
        </div>
    </div>

    <hr class="my-4">

    <h5 class="mb-3">ثبت نظر شما</h5>

    <form method="POST" action="{{ url('/products/'.$product->id.'/review') }}" class="mb-4">
        @csrf

        <div class="mb-3">
            <label class="fw-bold">امتیاز شما</label>
            <select name="rating" class="form-select w-auto">
                <option value="5">۵ ⭐</option>
                <option value="4">۴ ⭐</option>
                <option value="3">۳ ⭐</option>
                <option value="2">۲ ⭐</option>
                <option value="1">۱ ⭐</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="fw-bold">متن نظر</label>
            <textarea name="comment" class="form-control" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-success">ثبت نظر</button>
    </form>

    <h5 class="mb-3">نظرات کاربران</h5>

    @forelse($reviews as $review)
        <div class="border-bottom pb-2 mb-2">
            <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong>
            <span class="text-warning">{{ $review->rating }} ⭐</span>
            <p class="mb-0">{{ $review->comment }}</p>
        </div>
    @empty
        <p class="text-muted">هنوز نظری برای این محصول ثبت نشده است.</p>
    @endforelse

@endsection
