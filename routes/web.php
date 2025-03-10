<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
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
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('home');

    Route::get('/post', [PostController::class, 'posts'])->name('posts.index');
    Route::get('/post/{post}', [PostController::class, 'postShow'])->name('post.show');

    Route::middleware(['role'])->group(function (){
        Route::get('/create/post', [PostController::class, 'postCreate'])->name('post.create');
        Route::get('/myPost/post', [PostController::class, 'myPost'])->name('post.myPost');
        Route::post('/post/store', [PostController::class, 'postStore'])->name('post.store');
        Route::get('/post/{post}/edit', [PostController::class, 'postEdit'])->name('post.edit');
        Route::put('/post/{post}/update', [PostController::class, 'postUpdate'])->name('post.update');
        Route::delete('/post/{post}/delete', [PostController::class, 'deletePost'])->name('post.delete');

        
        Route::get('/admin/panel', [AdminController::class, 'adminPanel'])->name('admin.panel');

        Route::get('/user/{user}/edit', [AdminController::class, 'userEdit'])->name('admin.userEdit');
        Route::put('/user/{user}/update', [AdminController::class, 'userUpdate'])->name('admin.userUpdate');
        Route::delete('/user/{user}/delete', [AdminController::class, 'deleteUser'])->name('admin.userDelete');

        Route::get('/category/create', [AdminController::class, 'createCategory'])->name('admin.categoryCreate');
        Route::post('/category/store', [AdminController::class, 'storeCategory'])->name('admin.categoryStore');
        
        Route::get('/category/{category}/edit', [AdminController::class, 'categoryEdit'])->name('admin.categoryEdit');
        Route::put('/category/{category}/update', [AdminController::class, 'categoryUpdate'])->name('admin.categoryUpdate');
        Route::delete('/category/{category}/delete', [AdminController::class, 'deleteCategory'])->name('admin.categoryDelete');
    });

    Route::post('/post/{post}/comment', [CommentController::class, 'commentStore'])->name('comment.store');
    Route::delete('/post/{post}/comment/{comment}', [CommentController::class, 'deleteComment'])->name('comment.delete');
    Route::post('/posts/{post}/like', [LikeController::class, 'toggleLike'])->name('post.like');
});

