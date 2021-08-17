<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;


Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');
    Route::post('/comments', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comments/{comments}/view', [CommentController::class, 'getCommentById'])->name('comment.view');


    Route::put('/comments/{comments}/update', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comments/{comments}/destroy', [CommentController::class, 'destroy'])->name('comment.destroy');


});

