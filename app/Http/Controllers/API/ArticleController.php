<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of all articles.
     */
    public function index()
    {
        $articles = Article::all();

        return response()->json([
            'status' => true,
            'message' => 'Tous les articles récupérés avec succès',
            'article' => $articles,
        ]);
    }

    public function latest()
    {
        $articles = Article::orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Les 10 dernières annonces récupérées avec succès',
            'article' => $articles,
        ]);
    }

    public function articlesByCategory1()
    {
        $articles = Article::where('category_id', 1)->get();

        return response()->json([
            'status' => true,
            'message' => 'Articles avec category_id 1 récupérés avec succès',
            'article' => $articles,
        ]);
    }

    public function articlesByCategory2()
    {
        $articles = Article::where('category_id', 2)->get();

        return response()->json([
            'status' => true,
            'message' => 'Articles avec category_id 2 récupérés avec succès',
            'article' => $articles,
        ]);
    }

    public function articlesByCategory3()
    {
        $articles = Article::where('category_id', 3)->get();

        return response()->json([
            'status' => true,
            'message' => 'Articles avec category_id 3 récupérés avec succès',
            'article' => $articles,
        ]);
    }

    public function articlesByCategory4()
    {
        $articles = Article::where('category_id', 4)->get();

        return response()->json([
            'status' => true,
            'message' => 'Articles avec category_id 4 récupérés avec succès',
            'article' => $articles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article = Article::create([
            'title' => $request->title,
            'address' => $request->address,
            'content' => $request->content,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
        ]);

        // Si une image est présente, enregistrement sur le disque et dans la table pictures
        if ($request->file('picture')) {
            $fileName = time() . '_' . $request->picture->getClientOriginalName();

            // Déplacement de l'image vers le dossier public/img
            $request->picture->move(public_path('img'), $fileName);

            // Enregistrement de l'image dans la table pictures
            $article->pictures()->create([
                'name' => $fileName,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'message' => 'Article trouvé',
            'status' => true,
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $article->update($request->except('picture'));

        if ($request->file('picture')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->picture && File::exists(public_path($article->picture))) {
                File::delete(public_path($article->picture));
            }

            // Enregistrement de la nouvelle image
            $fileName = time() . '_' . $request->picture->getClientOriginalName();
            $path = 'public/img/' . $fileName;
            $article->picture = $path;
            $request->picture->move(public_path('public/img'), $fileName);
            $article->save();
        }

        return response()->json([
            'status' => true,
            'article' => $article,
            'message' => 'Article modifié',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json(['message' => 'Article introuvable'], 404);
        }

        if ($article->picture && File::exists(public_path($article->picture))) {
            File::delete(public_path($article->picture));
        }
        
        $article->delete();
    
        return response()->json([
            'status' => true,
            'message' => 'Article supprimé',
        ]);
    }
}
