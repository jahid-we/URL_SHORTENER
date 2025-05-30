<?php

use App\Http\Controllers\UrlShortenerController;
use Illuminate\Support\Facades\Route;

// Shorten a new URL
Route::post('/shorten', [UrlShortenerController::class, 'createShortUrl'])->name('shorten');
// Redirect using short code (you can change the URL param name if needed)
Route::get('/{short_url}', [UrlShortenerController::class, 'redirectToOriginalUrl']);

// Home page route
Route::get('/', [UrlShortenerController::class, 'home']);
