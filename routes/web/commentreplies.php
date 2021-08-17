<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentRepliesController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    Route::get('/replies', [CommentRepliesController::class, 'index'])->name('reply.index');
    Route::post('/replies', [CommentRepliesController::class, 'storeReply'])->name('commentreply.store');
    Route::get('/replies/{replies}/view', [CommentRepliesController::class, 'getReplyById'])->name('reply.view');


    Route::put('/replies/{replies}/update', [CommentRepliesController::class, 'update'])->name('commentreply.update');
    Route::delete('/replies/{replies}/destroy', [CommentRepliesController::class, 'destroy'])->name('commentreply.destroy');


});