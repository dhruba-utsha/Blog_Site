<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    public function categories(){
        return $this->belongsToMany(Category::class, 'category_posts');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser()
    {
        return $this->likes()->where('user_id', Auth::id())->exists();
    }

    protected $fillable = [
        'title',
        'content',
        'image',
        'user_id'
    ];
}
