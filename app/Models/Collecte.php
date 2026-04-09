<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collecte extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'agent_id', 'agent_nom', 'nom_enquete', 'fonction', 'contact',
        'zone_etude', 'type_acteur', 'gps', 'date_collecte', 'chair_principale',
        'chairs_animales', 'frequence', 'quantite', 'connait_fermes', 'quelles_fermes',
        'souhaite_producteur', 'especes_preferees', 'criteres_achat', 'poids_clarias',
        'poids_tilapia', 'forme_achat', 'prix_clarias', 'prix_tilapia', 'nb_tilapia_kg',
        'nb_clarias_kg', 'frequence_appro', 'lieu_achat', 'mode_commande', 'mode_info',
        'contrat_interesse', 'contrat_quantite', 'exigences', 'recommandations',
        'photo_url', 'consentement', 'synchro'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}