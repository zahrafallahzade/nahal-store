<?php

namespace App\Http\Controllers\manager;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    public function index(Request $request)      //نمایش و فیلتر کاربران
    {
        $users = User::when($request->role, function($q) use ($request) {
            $q->where('role', $request->role);
        })->get();

        return view('manager.roles', compact('users'));
    }

    public function updateRole(Request $request, $id)    //تغییر نقش کاربر
    {
        $request->validate([
            'role' => 'required|in:user,admin,manager',
        ]);

        User::findOrFail($id)->update(['role' => $request->role]);

        return redirect('/manager/roles');
    }

}
