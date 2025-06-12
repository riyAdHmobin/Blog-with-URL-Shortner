<?php

use App\Http\Controllers\URLShortner\ShortUrlController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogTagController;
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

// Admin Blog Routes
Route::prefix('admin/blog')->middleware(['auth'])->group(function () {
    Route::resource('posts', BlogPostController::class);
    Route::resource('categories', BlogCategoryController::class);
    Route::resource('tags', BlogTagController::class);
});

// Public Blog Routes
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/post/{slug}', [BlogController::class, 'show'])->name('show');
    Route::get('/category/{slug}', [BlogController::class, 'category'])->name('category');
    Route::get('/tag/{slug}', [BlogController::class, 'tag'])->name('tag');
});
