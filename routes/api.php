<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsController;

Route::post('/user/register', [AccountController::class, "register"]);
Route::post('/user/login', [LoginController::class, "login"]);

// Sanctum Authenticated Routes
Route::middleware('auth:sanctum')->group(function (){
    Route::post('news', [NewsController::class, 'index']);
});
