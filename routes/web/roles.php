<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;


Route::middleware(['auth', 'userStatusAccount'])->group(function () {

    Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
    Route::post('/roles/store', [RoleController::class, 'store'])->name('role.store');
    Route::get('/roles/{roles}/edit', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/roles/{roles}/update', [RoleController::class, 'update'])->name('role.update');
    Route::put('/roles/{roles}/attach', [RoleController::class, 'attachPermission'])->name('role.permission.attach');
    Route::put('/roles/{roles}/detach', [RoleController::class, 'detachPermission'])->name('role.permission.detach');
    Route::delete('/roles/{roles}/destroy', [RoleController::class, 'destroy'])->name('role.destroy');



    // Route::get('admin/roles',[UserController::class:'index'])->name('role.index');

});