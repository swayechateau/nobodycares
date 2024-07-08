<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/', function () {
    return redirect(app()->getLocale());
});

Route::group(['prefix' => '{locale}', 'middleware' => 'web'], function () {
    Route::get('/', [PostController::class, 'home'])->name('home');
    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{slug}', [PostController::class, 'show'])->name('posts.show');
    Route::get('categories', [PostController::class, 'categories'])->name('categories');
});
