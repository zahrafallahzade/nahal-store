<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller{
    public function register(Request $request){
        $request->validate([
            'first_name'=>'required|string',
            'last_name'=>'required|string',
            'username'=>'required|unique:users,username',
            'phone'=>'required|unique:users,phone|digits:11',
            'password'=>'required|min:6|max:12'
        ]);

        $user=User::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'username'=>$request->username,
            'phone'=>$request->phone,
            'password'=>$request->password,
            'role'=>'user'
        ]);

        Auth::login($user);

        return redirect('/');
    }
}
