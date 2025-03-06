<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

Route::get('/', [UserController::class, 'landingPage'])->name('welcome');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');

Route::get('/registration', [UserController::class, 'registration'])->name('registration');
Route::post('/registration', [UserController::class, 'registrationPost'])->name('registration.post');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('home');

    Route::get('/post', [PostController::class, 'posts'])->name('posts.index');
    Route::get('/post/{post}', [PostController::class, 'postShow'])->name('post.show');

    Route::middleware(['role'])->group(function (){
        Route::get('/create/post', [PostController::class, 'postCreate'])->name('post.create');
        Route::get('/myPost/post', [PostController::class, 'myPost'])->name('post.myPost');
        Route::post('/post/store', [PostController::class, 'postStore'])->name('post.store');
        Route::get('/post/{post}/edit', [PostController::class, 'postEdit'])->name('post.edit');
        Route::put('/post/{post}/update', [PostController::class, 'postUpdate'])->name('post.update');
        Route::delete('/post/{post}/delete', [PostController::class, 'deletePost'])->name('post.delete');
    });

    Route::post('/post/{post}/comment', [CommentController::class, 'commentStore'])->name('comment.store');
    Route::delete('/post/{post}/comment/{comment}', [CommentController::class, 'deleteComment'])->name('comment.delete');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('post.like');
});

