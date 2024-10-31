<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

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

        return response()->json([
            'message' => 'Article ajouté avec succès',
            'status' => true,
            'article' => $article,
        ], 201);
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
        $article->update([
            'title' => $request->title,
            'address' => $request->address,
            'content' => $request->content,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);

        return response()->json([
            'status' => true,
            'article' => $article,
            'message' => 'Article modifié',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            'status' => true,
            'article' => $article,
            'message' => 'Article supprimé',
        ]);
    }
}
