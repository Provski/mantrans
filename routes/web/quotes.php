<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    
    Route::get('/quotes', [QuoteController::class, 'index'])->name('quote.index');
    Route::get('/quotes/create', [QuoteController::class, 'create'])->name('quote.create');
    Route::post('/quotes', [QuoteController::class, 'store'])->name('quote.store');
    Route::get('/quotes/{quotes}/view', [QuoteController::class, 'getQuoteById'])->name('quote.view');
    Route::get('/quotes/{quotes}/edit', [QuoteController::class, 'edit'])->name('quote.edit');
    Route::delete('/quotes/{quotes}/destroy', [QuoteController::class, 'destroy'])->name('quote.destroy');
    Route::put('/quotes/{quotes}/update', [QuoteController::class, 'update'])->name('quote.update');
    
});