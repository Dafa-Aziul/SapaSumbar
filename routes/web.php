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
Route::get('/login', [LoginUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginUserController::class, 'login'])->name('login.store');
Route::post('/logout', [LoginUserController::class, 'logout'])->middleware('auth')->name('logout');

use Illuminate\Support\Facades\Route;

// Semua route di bawah hanya bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('pages.home');
    })->name('home');

    Route::get('/pengaduan-saya', function () {
        return view('pages.pengaduan-saya');
    })->name('pengaduan-saya');

    Route::get('/notifikasi', function () {
        return view('pages.notifikasi');
    })->name('notifikasi');

    Route::get('/maps', function () {
        return view('pages.maps');
    })->name('maps');

    Route::get('/profile', function () {
        return view('pages.profile');
    })->name('profile');
});



Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin']);
