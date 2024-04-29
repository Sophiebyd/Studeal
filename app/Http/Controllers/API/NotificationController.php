<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    // Fonction pour renvoyer les notifications
    public function index()
    {
        //On récupère tous les notifications
        $notifications = Notification::all();

        //On retourne les notifications en JSON
        return response()->json([
            'status' => true,
            'message' => 'les notifications ont été récupérés avec succès',
            'notifications' => $notifications
        ]);    }

    // Fonction pour sauvegarder une nouvelle notification
    public function store(StorePaymentRequest $request)
    {
        $notification = Notification::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json([
            'message' => 'La notification a été ajoutée avec succès',
            'status' => true,
            'notification' => $notification,
        ], 201);
    }

    // Fonction pour supprimer une notification
    public function destroy(Notification $notification)
    {
        $notification->delete();
        return response()->json([
            'status' => true,
            'notification' => $notification,
            'message' => 'Notification supprimé',
        ]);
    }
}
