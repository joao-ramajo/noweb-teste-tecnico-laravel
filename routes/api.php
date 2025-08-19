<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth:sanctum']);

Route::prefix('users')->group(function() {
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
    });
    Route::post('/', [UserController::class, 'store'])->name('users.store');
});