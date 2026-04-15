<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteController;

// Créer le fichier SQLite s'il n'existe pas
$databasePath = database_path('database.sqlite');
if (!File::exists($databasePath)) {
    File::ensureDirectoryExists(dirname($databasePath));
    File::put($databasePath, '');
}

// Route pour initialiser la base de données
Route::get('/setup', function () {
    $databasePath = database_path('database.sqlite');
    if (!File::exists($databasePath)) {
        File::put($databasePath, '');
    }
    
    \DB::statement('PRAGMA foreign_keys=off;');
    \DB::statement('DROP TABLE IF EXISTS collectes;');
    \DB::statement('
        CREATE TABLE collectes (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER NULL,
            agent_id TEXT,
            agent_nom TEXT,
            nom_enquete TEXT,
            fonction TEXT,
            contact TEXT,
            zone_etude TEXT,
            type_acteur TEXT,
            gps TEXT,
            date_collecte TEXT,
            chair_principale TEXT,
            chairs_animales TEXT,
            frequence TEXT,
            quantite TEXT,
            connait_fermes TEXT,
            quelles_fermes TEXT,
            souhaite_producteur TEXT,
            especes_preferees TEXT,
            criteres_achat TEXT,
            poids_clarias TEXT,
            poids_tilapia TEXT,
            forme_achat TEXT,
            prix_clarias TEXT,
            prix_tilapia TEXT,
            nb_tilapia_kg TEXT,
            nb_clarias_kg TEXT,
            frequence_appro TEXT,
            lieu_achat TEXT,
            mode_commande TEXT,
            mode_info TEXT,
            contrat_interesse TEXT,
            contrat_quantite TEXT,
            exigences TEXT,
            recommandations TEXT,
            photo_url TEXT,
            consentement INTEGER,
            created_at TIMESTAMP,
            updated_at TIMESTAMP
        )
    ');
    \DB::statement('PRAGMA foreign_keys=on;');
    return 'Base de données initialisée et table collectes créée !';
});

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
