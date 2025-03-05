<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Like;
use App\Models\Post;

class LikeController extends Controller
{
    function toggleLike(Post $post)
    {
        $user_id = Auth::id();
        $post_id = $post->id;

        if ($post->isLikedByUser()) {
            Like::where('post_id', $post->id)->where('user_id', $user_id)->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user_id,
                'post_id' => $post_id
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likeCount' => $post->likes()->count(),
        ]);
    }
}
