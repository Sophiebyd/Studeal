<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Requests\StoreArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    // middleware sanctum
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index, show');
    }

    public function index()
    {
        $articles = Article::all();

        return response()->json([
            'status' => true,
            'message' => 'Tous les articles avec succès',
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
            'content' => $request->content,
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
    public function update(StoreArticleRequest $request, Article $article)
    {
        $article->update($request->all());

        return response()->json([
            'status' => true,
            'article' => $article,
            'message' => 'Utilisateur modifié',
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
