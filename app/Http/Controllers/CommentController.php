<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\Post;
use  App\Models\Comment;

class CommentController extends Controller
{
    function commentStore(Request $request, Post $post)
    {
        $request->validate([
            'body' => 'required',
        ]);

        $user_id = Auth::id();
        $post_id = $post->id;
        
        Comment::create([
            'body' => $request->body,
            'user_id' => $user_id,
            'post_id' => $post_id
        ]);

        return redirect(route('post.show', $post->id));
    }

    public function deleteComment(Post $post, Comment $comment)
    {
        if (Auth::id() === $comment->user_id || Auth::id() === $post->user_id) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }

        return back()->with('error', 'Unauthorized to delete this comment.');
    }

}
