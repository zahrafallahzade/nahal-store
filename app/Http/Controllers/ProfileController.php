<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required',
            'phone' => 'required|digits:11',
            'province' => 'required',
            'city' => 'required',
            'address' => 'required',
            'plaque' => 'required',
            'unit' => 'required',
            'postal_code' => 'required',
        ]);

        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone' => $request->phone,
        ]);

        Address::updateOrCreate(
            ['user_id' => $user->id],  //مشخص می‌کند باید دنبال آدرسی بگردیم که user_id آن متعلق به کاربر فعلی باشد
            $request->only(['province', 'city', 'address', 'plaque', 'unit', 'postal_code'])   //فقط فیلدهای مشخص‌شده را از اطلاعات فرم انتخاب می‌کند و تحویل می‌دهد
        );

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6|max:12',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'رمز عبور فعلی اشتباه است.']);
        }

        $user->update(['password' => Hash::make($request->new_password)]);

        return back()->with('success', 'رمز عبور با موفقیت تغییر کرد.');
    }
}
