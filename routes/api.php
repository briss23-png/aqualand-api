<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteController;

// Route de test (sans base de données)
Route::get('/test', function () {
    return response()->json(['message' => 'API fonctionne !']);
});

// Routes normales (avec base)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/collectes', [CollecteController::class, 'store']);
Route::get('/collectes', [CollecteController::class, 'index']);
Route::get('/collectes/agent/{agentId}', [CollecteController::class, 'getByAgent']);
Route::get('/collectes/{id}', [CollecteController::class, 'show']);
// Créer le fichier SQLite s'il n'existe pas
if (!File::exists(database_path('database.sqlite'))) {
    File::put(database_path('database.sqlite'), '');
}
Route::get('/migrate', function () {
    try {
        \Artisan::call('migrate', ['--force' => true]);
        return response()->json(['message' => 'Migration réussie', 'output' => \Artisan::output()]);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
