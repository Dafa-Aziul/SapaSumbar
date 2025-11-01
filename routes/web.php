<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\LoginUserController;

// Register
Route::get('/register', [RegisterUserController::class, 'showRegisterForm'])->name('register.show');
Route::post('/register', [RegisterUserController::class, 'register'])->name('register.store');

// OTP
Route::get('/verify-otp', [OtpVerificationController::class, 'showForm'])->name('otp.show');
Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('otp.verify');

// Login / Logout
Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login.show');
Route::post('/login', [LoginUserController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginUserController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');


Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin']);
