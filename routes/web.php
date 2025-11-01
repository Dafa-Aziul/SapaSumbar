<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Livewire\Homepage\Index as HomepageIndex;
use App\Livewire\Mycomplaint\Index as MyComplaintIndex;
use App\Livewire\Profile\Index as ProfileIndex;
use Illuminate\Support\Facades\Route;


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

// Semua route di bawah hanya bisa diakses jika sudah login
Route::middleware(['auth'])->group(function () {

    Route::get('/', HomepageIndex::class)->name('home');

    Route::get('/my-complaints', MyComplaintIndex::class)->name('my-complaints');

    Route::get('/profile', ProfileIndex::class)->name('profile');

    // Route::get('/pengaduan-saya', function () {
    //     return view('pages.pengaduan-saya');
    // })->name('pengaduan-saya');

    // Route::get('/notifikasi', function () {
    //     return view('pages.notifikasi');
    // })->name('notifikasi');

    // Route::get('/maps', function () {
    //     return view('pages.maps');
    // })->name('maps');

    // Route::get('/profile', function () {
    //     return view('pages.profile');
    // })->name('profile');
});



Route::get('/admin-dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'admin']);
