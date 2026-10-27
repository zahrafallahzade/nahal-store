<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public function update(Request $request)  //ویرایش اطلاعات حساب کاربری
    {
        $request->validate([ //اعتبار سنجی
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required',
            'phone' => 'required|digits:11',
        ]);

        $user = Auth::user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->username,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'اطلاعات با موفقیت ذخیره شد.');
    }

    public function changePassword(Request $request)   //تغییر رمز عبور
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
