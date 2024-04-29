<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Fonction pour renvoyer les messages
    public function index()
    {
        //On récupère tous les messages
        $messages = Message::all();

        //On retourne les messages en JSON
        return response()->json([
            'status' => true,
            'message' => 'Les messages récupérés avec succès',
            'messages' => $messages
        ]);
    }

    // Fonction pour sauvegarder un nouvel message
    public function store(StoreMessageRequest $request)
    {
        $message = Message::create([
            'content' => $request->content,
            'user1_id'=> auth()->user()->id,
            'user2_id'=> $request->user2_id,
            'article_id'=> $request->article_id
        ]);

        return response()->json([
            'message' => 'Le message a été envoyé avec succès',
            'status' => true,
            'message' => $message,
        ], 201);
    }

    // Fonction pour supprimer un message
    public function destroy(Message $message)
    {
        $message->delete();
        return response()->json([
            'status' => true,
            'message' => $message,
            'message' => 'Message supprimé',
        ]);
    }
}
