<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OpcionController;
use App\Http\Controllers\PanelProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubFiltroController;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    $proveedores = Proveedor::all(); // Obtener los proveedores
    return view('home', compact('proveedores')); // Pasarlos a la vista
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

Route::get('/producto/{id}/{slug}', [ProductController::class, 'show'])->name('producto.detalles');
Route::get('/productos', [ProductController::class, 'index'])->name('products');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/', [CategoriaController::class, 'index'])->name('home');

Route::get('/productos/filter', [ProductController::class, 'filter'])->name('productos.filter');
Route::get('/latest-products', [ProductController::class, 'getLatestProducts'])->name('latest.products');
Route::get('/producto/{id}', [ProductController::class, 'show'])->name('product.show');

///////////////////////////////////BANNER ADMIN////////////////////////////////////

Route::get('/slider', [SliderController::class, 'mostrarSlider'])->name('slider.mostrar');

///////////////////////////////////BANNER ADMIN////////////////////////////////////


//////////////////////////////////PROVEEDORES////////////////////////////////////

Route::get('/api/proveedores', [ProveedorController::class, 'obtenerProveedores']);

//////////////////////////////////PROVEEDORES////////////////////////////////////


//////////////////////////////////FILTROS////////////////////////////////////
// Filtrar productos por categoría
Route::get('/productos/categoria/{categoria}', [ProductController::class, 'filtrarPorCategoria'])
    ->name('products.by.categoria');

// Filtrar productos por grupo
Route::get('/productos/grupo/{grupo}', [ProductController::class, 'filtrarPorGrupo'])
    ->name('products.by.grupo');

// Filtrar productos por subgrupo
Route::get('/productos/subgrupo/{subgrupo}', [ProductController::class, 'filtrarPorSubgrupo'])
    ->name('products.by.subgrupo');

//////////////////////////////////FILTROS////////////////////////////////////

//////////////////////////////////API/////////////////////////////////////
Route::get('/api/subfiltros/{categoria_id}', [SubFiltroController::class, 'getSubFiltrosPorCategoria']);
//////////////////////////////////API/////////////////////////////////////


//////////////////////////////////OPCIONES/////////////////////////////////////

Route::prefix('panel')->group(function () {
    Route::get('/productos/asignar-opciones', [PanelProductoController::class, 'asignarOpciones'])->name('panel.productos.asignar_opciones');
    Route::post('/productos/guardar-opciones', [PanelProductoController::class, 'guardarOpciones'])->name('panel.productos.guardar_opciones');
});

Route::get('/api/opciones/{subfiltro_id}', [OpcionController::class, 'getOpcionesPorSubfiltro']);

//////////////////////////////////OPCIONES/////////////////////////////////////

//////////////////////////////////ERROR 404/////////////////////////////////////

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

//////////////////////////////////ERROR 404/////////////////////////////////////

require __DIR__ . '/admin.php';