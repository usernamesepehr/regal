<?php

use App\Http\Controllers\blogController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\mainpageController;
use App\Http\Controllers\showProductController;
use App\Http\Controllers\wishlistController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [mainpageController::class, 'index'])->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');


Route::prefix('products')->group(function() {
    Route::get('/', [showProductController::class, 'index']);
    Route::get('/{slug}', [showProductController::class, 'get']);
});

Route::prefix('blogs')->group(function() {
    Route::get('/', [blogController::class, 'all'])->name('blogs');
    Route::get('/{slug}', [blogController::class, 'get'])->name('home');
}); 

Route::prefix('categories')->group(function() {
    Route::get('/', [categoryController::class, 'index']);
    Route::get('/{slug}', [categoryController::class, 'get']);
});




Route::get('/cart', function () {
    return Inertia::render('CartPage');
})->name('home');

Route::get('/terms', function () {
    return Inertia::render('TermsPage');
})->name('home');

Route::get('/privacy', function () {
    return Inertia::render('PrivacyPage');
})->name('home');

Route::get('/compare', function () {
    return Inertia::render('ComparePage');
})->name('home');

Route::post('/wishlist/{id}', [wishlistController::class, 'add'])->withoutMiddleware(VerifyCsrfToken::class);

require __DIR__ . "/auth.php";
require __DIR__ . "/userPanel.php";
