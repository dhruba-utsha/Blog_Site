<?php

namespace App\Http\Controllers;

// use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use  App\Models\User;
use  App\Models\Post;

use function Laravel\Prompts\password;

class UserController extends Controller
{
    function landingPage()
    {
        $posts = Post::all();
        return view('welcome', ['posts' => $posts]);
    }


    function login(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('login');
    }


    function registration(){
        if(Auth::check()){
            return redirect(route('home'));
        }
        return view('registration');
    }


    function loginPost(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials)){
            return redirect(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }


    function registrationPost(Request $request){
        $data = $request->validate([
            'role' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $data['password']= Hash::make($request->password);
        $user = User::create($data);

        if($user){
            return redirect(route('home'));
        }
        return redirect(route('registration'))->with("error", "Registration details are not valid");
    }


    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
