<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth')->group(function () {
   
    Route::get('/',[UserController::class,'view_admin'])->name('admin.view_admin');
    Route::get('create', [UserController::class, 'create'])->name('admin.create');
    Route::post('store', [UserController::class, 'store'])->name('admin.store');
    Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.edit');
    Route::get('logout', [UserController::class, 'logout'])->name('admin.logout');
    Route::delete('delete_admin/{id}', [UserController::class, 'destroy'])->name('admin.destroy');
    Route::put('update_admin/{id}', [UserController::class, 'update'])->name('admin.update');
    Route::get('blog', [BlogController::class, 'view_blog'])->name('blog.view_blog');
    Route::get('blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::delete('blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.destroy');
    Route::put('blog/update/{id}',[BlogController::class,'update'])->name('blog.update');
});

Route::get('login',[UserController::class,'login'])->name('login');
Route::post('aksi_login',[UserController::class,'aksi_login'])->name('admin.aksi_login');
Route::get('blog/detail/{slug}',[BlogController::class,'blog_detail'])->name('blog.detail');
Route::post('/blog/{blog_id}/like', [BlogController::class, 'like'])->name('blog.like');
Route::post('/blog/{blogId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('register',[UserController::class,'register'])->name('register');
Route::post('store', [UserController::class, 'store'])->name('user.store');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('/', [BlogController::class, 'index'])->name('index');