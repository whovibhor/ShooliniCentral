<?php

use Illuminate\Support\Facades\Route;

// Homepage route
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/home', function () {
    return redirect('/');
});
