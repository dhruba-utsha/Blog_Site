<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->user()->role === 'admin') {
            return $next($request);
        }

        if ($request->user()->role === 'author') {

            if ($request->is('create/post') || ($request->isMethod('POST') && $request->is('post/store'))) {
                return $next($request);
            }

            $post = $request->route('post');
            if ($post && $post->user_id === $request->user()->id) {
                return $next($request);
            }
        }

        abort(403, 'Unauthorized action.');

    }
}
