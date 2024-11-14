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
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\ContactController;

// Ressources API
Route::apiResource("/articles", ArticleController::class);
Route::apiResource("/categories", CategoryController::class);
Route::apiResource("/commands", CommandController::class);
Route::apiResource("/messages", MessageController::class);
Route::apiResource("/notifications", NotificationController::class);
Route::apiResource("/payments", PaymentController::class);

// Route::apiResource("/pictures", PictureController::class);
Route::apiResource("/users", UserController::class);

// Route pour obtenir les 10 derniers articles
Route::get('/latest', [ArticleController::class, 'latest']);

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

//Route protégée par l'authentification
Route::middleware('auth:sanctum')->group(function () { 
    Route::post('/newArticle', [ArticleController::class, 'store']); 
    Route::put('/newAvatar/{user}', [UserController::class, 'update']);
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
});

// Route pour le mail
Route::post('/contact', [ContactController::class, 'sendMail']);

// Utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Mise à jour utilisateur (policies)
route::patch('/users/{user}', [UserController::class, 'update'])->name('users.update');
