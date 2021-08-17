<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    
    Route::get('/authors', [AuthorController::class, 'index'])->name('author.index');
    Route::get('/authors/create', [AuthorController::class, 'create'])->name('author.create');
    Route::post('/authors', [AuthorController::class, 'store'])->name('author.store');
    Route::get('/authors/{authors}/view', [AuthorController::class, 'getAuthorById'])->name('author.view');
    Route::get('/authors/{authors}/edit', [AuthorController::class, 'edit'])->name('author.edit');
    Route::delete('/authors/{authors}/destroy', [AuthorController::class, 'destroy'])->name('author.destroy');
    Route::put('/authors/{authors}/update', [AuthorController::class, 'update'])->name('author.update');

});
