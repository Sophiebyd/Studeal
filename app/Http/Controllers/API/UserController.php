<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    // Middleware
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
    }

    // Fonction pour renvoyer la liste des utilisateurs
    public function index()
    {
        // On récupère tous les utilisateurs
        $users = User::all();

        // On retourne les utilisateurs en JSON
        return response()->json([
            'status' => true,
            'message' => 'Utilisateurs récupérés avec succès',
            'users' => $users
        ]);
    }

    // Fonction pour sauvegarder un nouvel utilisateur
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birthday' => $request->birthday,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Utilisateur ajouté avec succès',
            'status' => true,
            'user' => $user,
        ], 201);
    }

    // Fonction pour récupérer les infos d'un utilisateur spécifique
    public function show(User $user)
    {
        return response()->json([
            'message' => 'Utilisateur trouvé',
            'status' => true,
            'user' => $user,
        ]);
    }

    // Fonction pour mettre à jour les informations d'un utilisateur
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->except('picture'));
        Log::info('test');

        if ($request->picture) {
            Log::info('test 2');
            // Suppression de l'ancienne image si elle existe
            if ($user->picture && File::exists(public_path($user->picture))) {
                File::delete(public_path($user->picture));
            }
            
            // Enregistrement de la nouvelle image
            $fileName = time() . '_' . $request->picture->getClientOriginalName();
            $path = 'public/img/' . $fileName;
            $user->picture = $path;
            $request->picture->move(public_path('public/img'), $fileName);
            $user->save();
        }

        return response()->json([
            'status' => true,
            'user' => $user,
            'message' => 'Utilisateur modifié',
        ]);
    }

    // Fonction pour supprimer un utilisateur
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'status' => true,
            'message' => 'Utilisateur supprimé',
        ]);
    }
}
