<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// use App\Http\Controllers\RoleController;
use App\Http\Controllers\PasswordController;


Route::middleware(['auth','userStatusAccount'])->group(function () {
    
    //Only Manager & User Access for User Profile Configuration
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/{users}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/users/{users}/update', [UserController::class, 'update'])->name('user.profile.update');

    // Only User himself to change his own password
    Route::get('/users/{users}/password', [PasswordController::class, 'edit'])->name('user.password.edit');
    Route::put('/users/{users}/password', [PasswordController::class, 'update'])->name('user.password.update');

    // Only Admin Access for User Profile & Role Configuration
    Route::get('/users/{users}/profile_and_role',[UserController::class,'modify'])->name('user.profile_role.update');
    Route::put('/users/{users}/profile_and_role',[UserController::class,'update'])->name('user.profile_role.update');
    Route::get('/users/user_list', [UserController::class, 'userList'])->name('user_list.index');
    Route::put('/users/{users}/attach', [UserController::class, 'attach'])->name('user.role.attach');
    Route::put('/users/{users}/detach', [UserController::class, 'detach'])->name('user.role.detach');
    Route::delete('/users/{users}/destroy', [UserController::class, 'userDestroy'])->name('user.destroy');


    // Only Manager Access to granted User login
    Route::get('changeStatus', [UserController::class, 'changeStatus'])->name('changeStatus');
});