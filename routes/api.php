<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth:sanctum']);

Route::prefix('users')->group(function() {
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
    });
    Route::post('/', [UserController::class, 'store'])->name('users.store');
});

Route::prefix('articles')->group(function() {
    Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
});

Route::apiResource('articles', ArticleController::class);