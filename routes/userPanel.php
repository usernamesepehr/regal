<?php

use App\Http\Controllers\userController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::controller(userController::class)->group(function() {
    Route::get('/user' , [userController::class, 'get_info'])->withoutMiddleware(VerifyCsrfToken::class);
    Route::post('/user/update' , [userController::class, 'update_info'])->withoutMiddleware(VerifyCsrfToken::class);
});

Route::get('/account', function () {
    return Inertia::render('AccountPage');
})->name('home');

Route::get('/account/edit', function () {
    return Inertia::render('AccountEditPage');
})->name('home');

Route::get('/account/orders', function () {
    return Inertia::render('AccountOrdersPage');
})->name('home');

Route::get('/account/wishlist', function () {
    return Inertia::render('AccountWishPage');
})->name('home');

Route::get('/account/address', function () {
    return Inertia::render('AccountAddressPage');
})->name('home');
