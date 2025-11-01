<?php

use App\Http\Controllers\Auth\LoginUserController;
use App\Http\Controllers\Auth\OtpVerificationController;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Livewire\Homepage\Index as HomepageIndex;
use App\Livewire\Maps\Index as MapsIndex;
use App\Livewire\Mycomplaint\Index as MyComplaintIndex;
use App\Livewire\Profile\Index as ProfileIndex;
use App\Livewire\Notification\Index as NotificationIndex;
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

    Route::get('/my-complaints', MyComplaintIndex::class)->name('my-complaints')->middleware('user');

    Route::get('/profile', ProfileIndex::class)->name('profile')->middleware('user');

    Route::get('/notifications', NotificationIndex::class)->name('notifications')->middleware('user');

    Route::get('/maps', MapsIndex::class)->name('maps');

});

