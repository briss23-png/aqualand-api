<?php

namespace App\Http\Controllers;

use App\Models\Collecte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollecteController extends Controller
{
    // Envoyer une collecte (depuis l'app mobile)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'agent_id' => 'required|string',
            'agent_nom' => 'required|string',
            'nom_enquete' => 'required|string',
            'contact' => 'required|string',
            'zone_etude' => 'required|string',
            'type_acteur' => 'required|string',
            'gps' => 'required|string',
            'date_collecte' => 'required|string',
            'consentement' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Trouver l'utilisateur par son agent_id
        $user = \App\Models\User::where('agent_id', $request->agent_id)->first();

        $collecte = Collecte::create([
            'user_id' => $user ? $user->id : null,
            'agent_id' => $request->agent_id,
            'agent_nom' => $request->agent_nom,
            'nom_enquete' => $request->nom_enquete,
            'fonction' => $request->fonction,
            'contact' => $request->contact,
            'zone_etude' => $request->zone_etude,
            'type_acteur' => $request->type_acteur,
            'gps' => $request->gps,
            'date_collecte' => $request->date_collecte,
            'chair_principale' => $request->chair_principale,
            'chairs_animales' => $request->chairs_animales,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'connait_fermes' => $request->connait_fermes,
            'quelles_fermes' => $request->quelles_fermes,
            'souhaite_producteur' => $request->souhaite_producteur,
            'especes_preferees' => $request->especes_preferees,
            'criteres_achat' => $request->criteres_achat,
            'poids_clarias' => $request->poids_clarias,
            'poids_tilapia' => $request->poids_tilapia,
            'forme_achat' => $request->forme_achat,
            'prix_clarias' => $request->prix_clarias,
            'prix_tilapia' => $request->prix_tilapia,
            'nb_tilapia_kg' => $request->nb_tilapia_kg,
            'nb_clarias_kg' => $request->nb_clarias_kg,
            'frequence_appro' => $request->frequence_appro,
            'lieu_achat' => $request->lieu_achat,
            'mode_commande' => $request->mode_commande,
            'mode_info' => $request->mode_info,
            'contrat_interesse' => $request->contrat_interesse,
            'contrat_quantite' => $request->contrat_quantite,
            'exigences' => $request->exigences,
            'recommandations' => $request->recommandations,
            'photo_url' => $request->photo_url,
            'consentement' => $request->consentement,
            'synchro' => true,
        ]);

        return response()->json([
            'message' => 'Collecte enregistrée avec succès',
            'collecte' => $collecte
        ], 201);
    }

    // Récupérer toutes les collectes (pour admin)
    public function index()
    {
        $collectes = Collecte::with('user')->orderBy('created_at', 'desc')->get();
        return response()->json($collectes);
    }

    // Récupérer les collectes d'un agent spécifique
    public function getByAgent($agentId)
    {
        $collectes = Collecte::where('agent_id', $agentId)->orderBy('created_at', 'desc')->get();
        return response()->json($collectes);
    }

    // Récupérer une collecte spécifique
    public function show($id)
    {
        $collecte = Collecte::with('user')->find($id);
        if (!$collecte) {
            return response()->json(['message' => 'Collecte non trouvée'], 404);
        }
        return response()->json($collecte);
    }
}