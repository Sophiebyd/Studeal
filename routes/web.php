<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;

Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/{pathMatch}', function () {
    return view('welcome');
})->where('pathMatch', '.*');
