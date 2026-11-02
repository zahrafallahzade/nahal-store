<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LogController extends Controller{
    public function login(Request $request){
        $request->validate([
            'phone' => 'required|digits:11',
            'password' => 'required'
        ]);

        if(Auth::attempt(['phone' => $request -> phone,'password' => $request -> password])){

            $request->session()->regenerate();

            $user = Auth::user();

            if ($user->role === 'admin'){
                return redirect('/admin');
            } elseif ($user->role === 'manager'){
                return redirect('/manager');
            }else{
                return redirect('/');
            }
        }

        return back()->withErrors(['login' => 'شماره موبایل یا رمزعبور اشتباه است!']);
    }

    public function logout(Request $request){   //خروج از حساب

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
