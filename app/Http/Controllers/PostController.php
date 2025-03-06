<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\Post;
use  App\Models\Category;

class PostController extends Controller
{
    function posts()
    {
        $posts = Post::all();
        return view('posts.index', ['posts' => $posts, 'pageTitle' => 'All Blogs']);
    }


    public function postCreate()
    {
        $categories = Category::all();
        return view('posts.create', ['categories' => $categories]);
    }


    public function postStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png',
            'category_id' => 'required'
        ]);

        $user_id = Auth::id();
        $imagePath = $request->file('image')->store('images', 'public');

        $post = Post::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
            'user_id' => $user_id,
        ]);

        $post->categories()->sync($request->category_id);

        return redirect(route('posts.index'));
    }


    public function postShow(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function myPost()
    {
        $user_id = Auth::id();
        $posts = Post::where('user_id', $user_id)->get();
        return view('posts.index', ['posts' => $posts, 'pageTitle' => 'My Blogs']);
    }

    public function postEdit(Post $post)
    {
        $categories = Category::all();
        return view('posts.edit', [
            'post' => $post,
            'categories' => $categories
        ]);
    }


    public function postUpdate(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png',
            'category_id' => 'required',
        ]);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        $post->categories()->sync($request->category_id);
        return redirect(route('post.show', $post->id));
    }

    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect(route('posts.index'));
    }
}
