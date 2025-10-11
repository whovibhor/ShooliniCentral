<?php

use Illuminate\Support\Facades\Route;

// Landing page is served at /home
Route::get('/home', function () {
    return view('home');
})->name('home');

// Redirect root to /home
Route::get('/', function () {
    return redirect('/home');
});
