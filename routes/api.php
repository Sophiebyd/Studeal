<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("articles", App\Http\Controllers\API\ArticleController::class);

Route::apiResource("categories", App\Http\Controllers\API\CategoryController::class);

Route::apiResource("commands", App\Http\Controllers\API\CommandController::class);

Route::apiResource("messages", App\Http\Controllers\API\MessageController::class);

Route::apiResource("notifications", App\Http\Controllers\API\NotificationController::class);

Route::apiResource("payments", App\Http\Controllers\API\PaymentController::class);

Route::apiResource("pictures", App\Http\Controllers\API\PictureController::class);

Route::apiResource("users", App\Http\Controllers\API\UserController::class);