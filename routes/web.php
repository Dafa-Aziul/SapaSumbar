<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
});

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
