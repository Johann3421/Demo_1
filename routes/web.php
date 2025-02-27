<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/productos', function () {
    return view('products');
})->name('products');

Route::get('/carrito', function () {
    return view('cart');
})->name('cart');

Route::post('/carrito/agregar', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/carrito', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/favoritos/agregar', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
Route::get('/favoritos', [FavoriteController::class, 'viewFavorites'])->name('favorites.view');
Route::get('/producto/{id}/detalle', 'ProductoController@detalle')->name('producto.detalle');

Route::get('/producto/{id}', [ProductController::class, 'show'])->name('producto.detalles');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
