<?php

use App\Http\Controllers\authController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::post('/register', [authController::class, 'register'])->withoutMiddleware(VerifyCsrfToken::class);