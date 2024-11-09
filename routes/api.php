<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CommandController;
use App\Http\Controllers\API\MessageController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\PictureController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;

// Ressources API
Route::apiResource("/articles", ArticleController::class);
Route::apiResource("/categories", CategoryController::class);
Route::apiResource("/commands", CommandController::class);
Route::apiResource("/messages", MessageController::class);
Route::apiResource("/notifications", NotificationController::class);
Route::apiResource("/payments", PaymentController::class);
Route::apiResource("/pictures", PictureController::class);
Route::apiResource("/users", UserController::class);

// Route pour obtenir les 10 derniers articles
Route::get('/latest', [ArticleController::class, 'latest']);

// Route pour ajouter un article
Route::post('/newArticle', [ArticleController::class, 'store'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/newArticle', [ArticleController::class, 'store']);
    Route::put('/newAvatar', [UserController::class, 'update']);
});

// Route pour les catégories
Route::get('/category_1', [ArticleController::class, 'articlesByCategory1']);
Route::get('/category_2', [ArticleController::class, 'articlesByCategory2']);
Route::get('/category_3', [ArticleController::class, 'articlesByCategory3']);
Route::get('/category_4', [ArticleController::class, 'articlesByCategory4']);

// Récupérer les catégories
Route::get('/article_categories', [CategoryController::class, 'index']);

// Récupérer l'utilisateur role_id utilisateur
Route::get('/users', [UserController::class, 'index']);

// Authentification
Route::middleware('web')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Mise à jour utilisateur
route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
