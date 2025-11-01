<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterUserController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\OtpVerificationController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/register', [RegisterUserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterUserController::class, 'register'])->name('register.submit');

Route::get('/otp-confirmation', [OtpController::class, 'showOtpForm'])->name('otp.form');
Route::post('/otp-confirmation', [OtpController::class, 'verifyOtp'])->name('otp.verify');


Route::get('/verify-otp', [OtpVerificationController::class, 'showForm'])->name('otp.show');
Route::post('/verify-otp', [OtpVerificationController::class, 'verify'])->name('otp.verify');
