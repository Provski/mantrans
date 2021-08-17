<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{categories}/view', [CategoryController::class, 'getCategoryById'])->name('category.view');
    Route::get('/categories/{categories}/edit', [CategoryController::class, 'edit'])->name('category.edit');
    Route::delete('/categories/{categories}/destroy', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::put('/categories/{categories}/update', [CategoryController::class, 'update'])->name('category.update');
    
});