<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostController;
use App\Http\Middleware\EnsureTokenIsValid;

Route::get(
    '/update-posts', 
    [PostController::class, 'updatePosts']
)->middleware(EnsureTokenIsValid::class);

Route::get(
    '/posts', 
    [PostController::class, 'rfPosts']
)->middleware(EnsureTokenIsValid::class);