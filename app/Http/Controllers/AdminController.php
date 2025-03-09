<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    function adminPanel()
    {
        $users = User::all();
        $categories = Category::all();
        return view('admin.adminPanel', ['users' => $users, 'categories' => $categories]);
    }

    function userEdit(User $user)
    {
        $categories = Category::all();
        return view('admin.userEdit', ['user' => $user, 'categories' => $categories]);
    }


    function userUpdate(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required',
        ]);

        $user->update([
            'role' => $request->role,
        ]);

        return redirect()->route('admin.panel');
    }


    function deleteUser(User $user)
    {
        $user->delete();
        return redirect(route('admin.panel'));
    }
}
