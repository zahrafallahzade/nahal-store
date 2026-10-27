<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['user', 'product'])->latest()->get();
        return view('admin.reviews', compact('reviews'));
    }

    public function approve($id)    //تایید نظر
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => true]);
        return redirect('/admin/reviews');
    }

    public function flag($id)   //علامت گذاری نظر به عنوان تایید نشده
    {
        $review = Review::findOrFail($id);
        $review->update(['is_approved' => false]);

        $user = $review->user;
        $user->update(['bad_reviews_count' => $user->bad_reviews_count + 1]);

        return redirect('/admin/reviews');
    }
}
