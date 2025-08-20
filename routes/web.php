<?php

use App\Http\Controllers\blogController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');




Route::prefix('blogs')->group(function() {
    Route::get('/', [blogController::class, 'all'])->name('blogs');
    Route::get('/{slug}', [blogController::class, 'get'])->name('home');
}); 



Route::get('/categories', function () {
    return Inertia::render('Categoriespage');
})->name('home');

Route::get('/product/{slug}', function () {
    return Inertia::render('ProductsPage');
})->name('home');

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

require __DIR__ . "/auth.php";
require __DIR__ . "/userPanel.php";
