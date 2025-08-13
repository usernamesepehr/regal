<?php

use App\Http\Controllers\userController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;


Route::controller(userController::class)->group(function() {
    Route::get('/user' , [userController::class, 'get_info'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/user/update' , [userController::class, 'update_info'])->withoutMiddleware(VerifyCsrfToken::class);
});