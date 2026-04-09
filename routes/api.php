<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteController;
use Illuminate\Support\Facades\Route;

// Routes publiques
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Routes protégées (à protéger plus tard avec token)
Route::post('/collectes', [CollecteController::class, 'store']);
Route::get('/collectes', [CollecteController::class, 'index']);
Route::get('/collectes/agent/{agentId}', [CollecteController::class, 'getByAgent']);
Route::get('/collectes/{id}', [CollecteController::class, 'show']);