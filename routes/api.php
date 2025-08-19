<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::prefix('users')->group(function() {
    Route::middleware(['auth:sanctum'])->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
    });
    Route::post('/', [UserController::class, 'store'])->name('users.store');
});