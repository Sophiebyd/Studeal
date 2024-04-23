<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PictureController extends Controller
{
    // Fonction pour renvoyer les images
    public function index()
    {
        //On récupère toutes les images
        $pictures = Picture::all();

        //On retourne les images en JSON
        return response()->json([
            'status' => true,
            'message' => 'Les images ont été récupérées avec succès',
            'pictures' => $pictures
        ]);
    }

    // Fonction pour sauvegarder une nouvelle image
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        // renvoi d'un ou plusieurs messages d'erreur si champ(s) incorrect(s)
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('images'), $imageName);

        $picture = Picture::create([
            'name' => $request->name,
            'article_id'=> $request->article_id ?? null,
            'category_id'=> $request->category_id ?? null
        ]);

        return response()->json([
            'message' => 'Image ajoutée avec succès',
            'status' => true,
            'picture' => $picture,
        ], 201);
    }

    // Fonction pour récupérer une image spécifique
    public function show(Picture $picture)
    {
        return response()->json([
            'message' => `l'image a été trouvée`,
            'status' => true,
            'picture' => $picture,
        ]);
    }

    // Fonction pour supprimer une image
    public function destroy(Picture $picture)
    { {
            $picture->delete();
            return response()->json([
                'status' => true,
                'picture' => $picture,
                'message' => 'Image supprimée',
            ]);
        }
    }
}
