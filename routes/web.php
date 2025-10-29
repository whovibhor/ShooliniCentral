<?php

use Illuminate\Support\Facades\Route;

// Landing page is served at /home
Route::get('/home', function () {
    return view('home');
})->name('home');

// Dashboard layout sample
Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');

// Redirect root to /home
Route::get('/', function () {
    return redirect('/home');
});
