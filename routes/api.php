<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\NewsController;

Route::post('/user/register', [AccountController::class, "register"]);
Route::post('/user/login', [LoginController::class, "login"]);

// Sanctum Authenticated Routes
Route::middleware('auth:sanctum')->group(function (){
    // Retrieving and filtering news with POST
    // To retrieve all news at once nothing need to provide in post body
    // To retrieve news as pagination you can provide page=? & per_page=? in request body
    // To search news you need to provide keywords=? in request body
    // To filter news by category_id = ?, author_id = ?, source_id = ? any if them;
    // You can use all option at once or none of them
    Route::post('news', [NewsController::class, 'index']);
});
