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
        return view('admin.userEdit', ['user' => $user]);
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

    function createCategory()
    {
        return view('admin.createCategory');
    }

    function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect(route('admin.panel'));
    }

    function categoryEdit(Category $category)
    {
        return view('admin.categoryEdit', ['category' => $category]);
    }

    function categoryUpdate(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $category->update([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect(route('admin.panel'));
    }

    function deleteCategory(Category $category)
    {
        $category->delete();
        return redirect(route('admin.panel'));
    }
}
