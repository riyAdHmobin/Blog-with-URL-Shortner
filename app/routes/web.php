<?php

use App\Http\Controllers\URLShortner\ShortUrlController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/blogs', function () {
    return view('blogs');
});


Route::prefix('url-shortner')->group(function () {
    Route::get('/', [ShortUrlController::class, 'index'])->name('url.shortener');
    Route::get('/list', [ShortUrlController::class, 'list'])->name('url.list');
    Route::post('/shorten', [ShortUrlController::class, 'store'])->name('shorten');
});

Route::get('/{code}', [ShortUrlController::class, 'redirect'])->name('url.redirect');
