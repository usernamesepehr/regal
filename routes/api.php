<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\wishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('cart')->group(function() {
    Route::post('/', [cartController::class, 'add']);
    Route::get('/', [cartController::class, 'index']);
    Route::delete('/{id}', [cartController::class, 'destroy']);
});