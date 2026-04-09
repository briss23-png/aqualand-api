<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Inscription
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:4',
            'telephone' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Générer un ID agent unique (AG-001, AG-002...)
        $lastUser = User::orderBy('id', 'desc')->first();
        $lastNumber = $lastUser ? intval(substr($lastUser->agent_id, 3)) : 0;
        $agentId = 'AG-' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        $user = User::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telephone' => $request->telephone,
            'role' => 'agent',
            'agent_id' => $agentId,
        ]);

        return response()->json([
            'message' => 'Inscription réussie',
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'agent_id' => $user->agent_id,
                'role' => $user->role,
            ]
        ], 201);
    }

    // Connexion
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Email ou mot de passe incorrect'], 401);
        }

        return response()->json([
            'message' => 'Connexion réussie',
            'user' => [
                'id' => $user->id,
                'nom' => $user->nom,
                'email' => $user->email,
                'agent_id' => $user->agent_id,
                'role' => $user->role,
                'telephone' => $user->telephone,
            ]
        ]);
    }
}