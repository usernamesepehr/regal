<?php

use App\Http\Controllers\authController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::controller(authController::class)->group(function() {
    Route::get('/login', [authController::class, 'index'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/register', [authController::class, 'register'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/login', [authController::class, 'login'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::delete('/logout', [authController::class, 'logout'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::get('/otp', [authController::class, 'otp_generate'])->withoutMiddleware(VerifyCsrfToken::class)->name('otp-generate');
    Route::post('/otp', [authController::class, 'otp_check'])->withoutMiddleware(VerifyCsrfToken::class)->name('otp-check');
});

