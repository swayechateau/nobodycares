<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => '{locale}', 'middleware' => 'web'], function () {
    Route::get('posts/{slug}', [PostController::class, 'show']);
});

Route::get('{locale}/posts', [PostController::class, 'index']);