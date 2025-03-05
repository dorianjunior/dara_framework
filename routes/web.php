<?php

use App\Core\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AuthMiddleware;

// Rota Pública
Route::get('/', [UserController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);

// Rota Protegida
Route::middleware(AuthMiddleware::class)->group(function() {
    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile', [UserController::class, 'updateProfile']);
});