<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    Route::get('/like/{like}', [LikeController::class, 'like'])->name('like.index');
    
});