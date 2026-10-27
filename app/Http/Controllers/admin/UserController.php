<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index(){

        $users = User::where('role', 'user')->get();
        return view('admin.users', compact('users'));
    }

    public function ban($id){

        $user = User::findOrFail($id);
        $user->update(['is_banned' => true, 'banned_at' => now()]);
        return redirect('/admin/users');
    }

}
