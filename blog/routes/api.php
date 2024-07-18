<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/update-posts', [PostController::class, 'updatePosts']);
Route::get('/posts', [PostController::class, 'rfPosts']);