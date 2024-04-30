<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource("articles", App\Http\Controllers\API\ArticleController::class);

Route::apiResource("categories", App\Http\Controllers\API\CategoryController::class);

Route::apiResource("commands", App\Http\Controllers\API\CommandController::class);

Route::apiResource("messages", App\Http\Controllers\API\MessageController::class);

Route::apiResource("notifications", App\Http\Controllers\API\NotificationController::class);

Route::apiResource("payments", App\Http\Controllers\API\PaymentController::class);

Route::apiResource("pictures", App\Http\Controllers\API\PictureController::class);

Route::apiResource("users", App\Http\Controllers\API\UserController::class);

Route::post('login', [App\Http\Controllers\API\LoginController::class, 'login'])->name('login');

Route::post('logout', [App\Http\Controllers\API\LoginController::class, 'logout'])->name('logout')->middleware('auth:web');

