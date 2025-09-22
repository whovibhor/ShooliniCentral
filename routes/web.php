<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('confessions'));

Route::view('/confessions', 'pages.confessions')->name('confessions');
Route::view('/marketplace', 'pages.marketplace')->name('marketplace');
Route::view('/events', 'pages.events')->name('events');
Route::view('/lost-found', 'pages.lost-found')->name('lost-found');
Route::view('/stayconnect', 'pages.stayconnect')->name('stayconnect');
Route::view('/carpooling', 'pages.carpooling')->name('carpooling');

// Static pages and utilities
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/developer', 'pages.developer')->name('developer');
Route::view('/sitemap', 'pages.sitemap')->name('sitemap');
Route::view('/search', 'pages.search')->name('search');
