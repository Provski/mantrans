<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/login',[AuthController::class, 'showFormLogin'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->middleware('userStatusAccount');
Route::get('/register',[AuthController::class, 'showFormRegister'])->name('auth.register');
Route::post('/register', [AuthController::class, 'register']);