<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewSubmitController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $user = Auth::user();

        if ($user->isCurrentlyBanned()) {
            return back()->with('error', 'شما به‌دلیل ثبت نظرات نامناسب، به‌مدت ۷ روز از ثبت نظر محروم شده‌اید.');
        }

        Review::create([
            'user_id' => $user->id,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return back()->with('success', 'نظر شما ثبت شد و پس از تایید نمایش داده می‌شود.');
    }
}
