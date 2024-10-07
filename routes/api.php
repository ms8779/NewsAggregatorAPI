<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Auth\LoginController;

Route::post('/user/register', [AccountController::class, "register"]);
Route::post('/user/login', [LoginController::class, "login"]);
