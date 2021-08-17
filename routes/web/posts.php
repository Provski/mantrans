<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    
    Route::get('/posts', [PostController::class, 'index'])->name('post.index');
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
    Route::get('/posts/{posts}/view', [PostController::class, 'getPostById'])->name('post.view');
    Route::get('/posts/{posts}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::delete('/posts/{posts}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::put('/posts/{posts}/update', [PostController::class, 'update'])->name('post.update');

});

