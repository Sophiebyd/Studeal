<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index, show');
    }
    
    // Fonction pour renvoyer les paiements
    public function index()
    {
        //On récupère tous les paiements
        $payments = Payment::all();

        //On retourne les paiements en JSON
        return response()->json([
            'status' => true,
            'message' => 'Les paiements ont été récupérés avec succès',
            'payments' => $payments
        ]);
    }

    // Fonction pour sauvegarder un nouvel paiement
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create([
            'success' => $request->success,
            'price' => $request->price,
            'user_id' => auth()->user()->id,
            'command_id' => $request->command_id
        ]);

        return response()->json([
            'message' => 'Le paiement a été ajouté avec succès',
            'status' => true,
            'payment' => $payment,
        ], 201);
    }

    // Fonction pour récupérer les infos d'un paiement spécifique
    public function show(Payment $payment)
    {
        return response()->json([
            'message' => 'Le paiement a été trouvé',
            'status' => true,
            'payment' => $payment,
        ]);
    }

    // Fonction pour supprimer un paiement
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json([
            'status' => true,
            'payment' => $payment,
            'message' => 'paiement supprimé',
        ]);
    }
}
