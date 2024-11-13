<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function sendMail(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required|string',
        ]);

        $contact = $request->only(['first_name', 'last_name', 'email', 'phone', 'message']);

        Mail::to('contact@studeals.fr')->send(new ContactMail($contact));

        return response()->json(['message' => 'Email envoyé avec succès !'], 200);
    }
}
