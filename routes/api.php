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

// Utilisateur authentifié
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Authentification
Route::middleware('web')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

// Mise à jour utilisateur
route::patch('/users/{id}', [UserController::class, 'update'])->name('users.update');
