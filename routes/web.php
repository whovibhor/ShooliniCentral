<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminWebAuthController;
use App\Http\Controllers\AdminDashboardController;

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

// Marketplace routes - grouped under /marketplace prefix
Route::prefix('marketplace')->name('marketplace.')->group(function () {
    // Main marketplace page
    Route::view('/', 'pages.marketplace')->name('index');

    // Marketplace product detail
    Route::get('/product/{slug}', function(string $slug){
        return view('pages.marketplace-product', compact('slug'));
    })->name('product');

    // Marketplace sub-pages
    Route::view('/services', 'pages.services')->name('services');
    Route::view('/rentals', 'pages.rentals')->name('rentals');
    Route::view('/skill-exchange', 'pages.skill-exchange')->name('skill-exchange');
    Route::view('/tutoring', 'pages.tutoring')->name('tutoring');
    Route::view('/work-board', 'pages.work-board')->name('work-board');
    Route::view('/digital-goods', 'pages.digital-goods')->name('digital-goods');

    // User pages under marketplace
    Route::view('/profile', 'pages.profile')->name('profile');
    Route::view('/settings', 'pages.settings')->name('settings');
});

// Admin auth (web)
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminWebAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminWebAuthController::class, 'login'])->name('admin.login.post');
    Route::post('/logout', [AdminWebAuthController::class, 'logout'])->name('admin.logout');

    Route::get('/', function(){ return redirect()->route('admin.dashboard'); });
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
