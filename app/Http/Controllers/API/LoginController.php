<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Tenter la connexion utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Laravel tente de connecter le user si l'email existe ET si le mdp en clair correspond à celui hashé 
        if (Auth::attempt($credentials)) {

            // si la connexion fonctionne, on récupère l'utilisateur et on charge son rôle
            $authUser = User::find(Auth::user()->id)->load('role');

            // on renvoie la réponse 
            return response()->json($authUser);
        } else {
            // si échec de la connexion, on renvoie un message d'erreur
            return response()->json(['errors' => 'L\'utilisateur n\'existe pas ou le mot de passe est incorrect'], 401);
        }
    }

    /**
     * Tenter la connexion utilisateur.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        // déconnecte de la session en cours et invalide le token du cookie de session
        Auth::guard('web')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
}
