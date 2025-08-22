<?php

use App\Http\Controllers\cartController;
use App\Http\Controllers\wishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/cart', [cartController::class, 'add']);