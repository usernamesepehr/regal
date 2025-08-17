<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::get('/about', function () {
    return Inertia::render('About');
})->name('about');

Route::get('/blogs', function () {
    return Inertia::render('Blogs');
})->name('blogs');

Route::get('/blogs/{id}', function () {
    return Inertia::render('SingleBlog');
})->name('home');

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



require __DIR__ . "/auth.php";
require __DIR__ . "/userPanel.php";
