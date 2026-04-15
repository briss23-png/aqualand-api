<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CollecteController;
use Illuminate\Support\Facades\DB;

// PLUS BESOIN de File::exists ou database_path('database.sqlite') ici, 
// car on utilise maintenant PostgreSQL sur le réseau de Render.

// Route pour créer la table collectes sur PostgreSQL
Route::get('/fix', function () {
    try {
        // Supprime la table si elle existe déjà (CASCADE force la suppression)
        DB::statement('DROP TABLE IF EXISTS collectes CASCADE;');
        
        // Création de la table avec la syntaxe PostgreSQL
        DB::statement("
            CREATE TABLE collectes (
                id SERIAL PRIMARY KEY,
                user_id INTEGER NULL,
                agent_id TEXT NULL,
                agent_nom TEXT NULL,
                nom_enquete TEXT NULL,
                fonction TEXT NULL,
                contact TEXT NULL,
                zone_etude TEXT NULL,
                type_acteur TEXT NULL,
                gps TEXT NULL,
                date_collecte TEXT NULL,
                chair_principale TEXT NULL,
                chairs_animales TEXT NULL,
                frequence TEXT NULL,
                quantite TEXT NULL,
                connait_fermes TEXT NULL,
                quelles_fermes TEXT NULL,
                souhaite_producteur TEXT NULL,
                especes_preferees TEXT NULL,
                criteres_achat TEXT NULL,
                poids_clarias TEXT NULL,
                poids_tilapia TEXT NULL,
                forme_achat TEXT NULL,
                prix_clarias TEXT NULL,
                prix_tilapia TEXT NULL,
                nb_tilapia_kg TEXT NULL,
                nb_clarias_kg TEXT NULL,
                frequence_appro TEXT NULL,
                lieu_achat TEXT NULL,
                mode_commande TEXT NULL,
                mode_info TEXT NULL,
                contrat_interesse TEXT NULL,
                contrat_quantite TEXT NULL,
                exigences TEXT NULL,
                recommandations TEXT NULL,
                photo_url TEXT NULL,
                consentement INTEGER DEFAULT 0,
                created_at TIMESTAMP NULL,
                updated_at TIMESTAMP NULL
            )
        ");

        return 'Succès : La table collectes a été créée sur PostgreSQL !';
    } catch (\Exception $e) {
        return 'Erreur lors de la création : ' . $e->getMessage();
    }
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
