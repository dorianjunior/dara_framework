<?php

use App\Core\Route;
use App\Http\Controllers\UserController;
use App\Middlewares\AuthMiddleware;

// Rota pública da API
Route::get('/api/users', [UserController::class, 'index']);

// Criar um usuário
Route::post('/api/users', [UserController::class, 'store']);