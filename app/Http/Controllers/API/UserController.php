<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    // middleware
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
    }
    
    // Fonction pour renvoyer la liste des utilisateurs
    public function index()
    {
        //On récupère tous les utilisateurs
        $users = User::all();

        //On retourne les utilisateurs en JSON
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


        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $user->update([
                'image' => $imageName
            ]);
            Picture::create([
                'name' => $imageName
            ]);
        }


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
        $user->update($request->all());

        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            
            $imagePath = 'images/' . $user->image;  // on supprime l'ancienne image (si existante)
            if (File::exists(public_path($imagePath))) {
                File::delete(public_path($imagePath));
            }
            
            Picture::create([
                'name' => $imageName
            ]);
            
            $user->update([
                'image' => $imageName
            ]);
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
            'user' => $user,
            'message' => 'Utilisateur supprimé',
        ]);
    }

}
