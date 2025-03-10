<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;

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

Route::get('/producto/{id}/{slug}', [ProductController::class, 'show'])->name('producto.detalles');
Route::get('/productos', [ProductController::class, 'index'])->name('products');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/', [CategoriaController::class, 'index'])->name('home');