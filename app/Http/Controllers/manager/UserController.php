<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Review;

class UserController extends Controller{

    public function index(){    //نمایش کاربران عادی و تعداد نظراتشان

        $users = User::where('role', 'user')->withCount('reviews')->get();
        return view('manager.users', compact('users'));
    }

    public function reviews($id){    //نمایش نظرات تأییدنشده‌ی یک کاربر

        $user = User::findOrFail($id);
        $reviews = $user->reviews()->where('is_approved', false)->with('product')->get();
        return view('manager.user-reviews', compact('user', 'reviews'));
    }

    public function deleteReviewComment($id){    //حذف متن نطر

        $review = Review::findOrFail($id);
        $review->update(['comment' => 'این نظر توسط مدیر حذف شده است.']);
        return back();
    }

}
