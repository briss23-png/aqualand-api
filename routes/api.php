<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteController;
use Illuminate\Support\Facades\DB;

// Route de test
Route::get('/test', function () {
    return response()->json(['message' => 'API fonctionne !']);
});

// Routes normales
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/collectes', [CollecteController::class, 'store']);
Route::get('/collectes', [CollecteController::class, 'index']);
Route::get('/collectes/agent/{agentId}', [CollecteController::class, 'getByAgent']);
Route::get('/collectes/{id}', [CollecteController::class, 'show']);
