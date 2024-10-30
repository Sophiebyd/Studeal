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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("/articles", ArticleController::class);

Route::apiResource("/categories", CategoryController::class);

Route::apiResource("/commands", CommandController::class);

Route::apiResource("/messages", MessageController::class);

Route::apiResource("/notifications", NotificationController::class);

Route::apiResource("/payments", PaymentController::class);

Route::apiResource("/pictures", PictureController::class);

Route::apiResource("/users", UserController::class);

///////////////////////////// Get /////////////////////////////////////////////////////////////
Route::get('/articles', [ArticleController::class, 'index']);

///////////////////////////// Post ////////////////////////////////////////////////////////////

Route::middleware('web')->group(function () {
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
});

///////////////////////////// Patch ////////////////////////////////////////////////////////////

route::patch('/users/{id}', [App\Http\Controllers\API\UserController::class, 'update'])->name('users.update');
