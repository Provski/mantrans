<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PermissionController;

Route::middleware(['auth', 'userStatusAccount'])->group(function () {
    
    Route::get('/permissions', [PermissionController::class, 'index'])->name('permission.index');
    Route::post('/permissions/store', [PermissionController::class, 'store'])->name('permission.store');
    Route::put('/permissions/{permissions}/update', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('/permissions/{permissions}/edit', [PermissionController::class, 'edit'])->name('permission.edit');
    Route::delete('/permissions/{permissions}/destroy', [PermissionController::class, 'destroy'])->name('permission.destroy');


});
