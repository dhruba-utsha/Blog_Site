<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Post;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::before(function (User $user) {
            if ($user->role === 'admin') {
                return true; 
            }
        });

        Gate::define('update', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}
