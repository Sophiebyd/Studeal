<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Command;
use Illuminate\Http\Request;

class CommandController extends Controller
{
    // Fonction pour renvoyer l'historique des commandes
    public function index()
    {
        //On récupère tous les utilisateurs
        $commands = Command::all();

        //On retourne les utilisateurs en JSON
        return response()->json([
            'status' => true,
            'message' => 'historique des commandes récupéré avec succès',
            'user' => $commands
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $command = Command::create([
            'price' => $request->price,
            'article_id' => $request->article_id,
            'user_id' => auth()->user()->id
        ]);

        return response()->json([
            'message' => 'commande sauvegardée',
            'status' => true,
            'command' => $command,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Command $command)
    {
        return response()->json([
            'message'=> 'commande trouvée',
            'status'=> true,
            'command'=>$command
        ]);
    }

    // Fonction pour supprimer un historique
    public function destroy(Command $command)
    {
        $command->delete();
        return response()->json([
            'status' => true,
            'command' => $command,
            'message' => 'commande supprimée',
        ]);
    }
}
