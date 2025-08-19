<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index'])->name('users.index')->middleware(['auth:sanctum']);
    Route::post('/', [UserController::class, 'store'])->name('users.store');
});

Route::middleware(['auth:sanctum'])->group(function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::apiResource('articles', ArticleController::class);
});



