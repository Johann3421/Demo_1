<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\EspecificacionController;
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
use App\Http\Controllers\ProductoController;
use Maatwebsite\Excel\Row;

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
// API-style para productos
Route::get('/api/productos', [ProductoController::class, 'getProductosBasicos']);
Route::get('/api/productos/{param}', function($param) {
    $controller = app(ProductoController::class);

    // Detectar si es ID numérico o slug
    if (is_numeric($param)) {
        return $controller->getProductoPorId($param);
    }
    return $controller->getProductoPorSlug($param);
});
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

//////////////////////////////////BUSCADOR/////////////////////////////////////

Route::get('/productos', [ProductController::class, 'index'])->name('productos.search');
Route::get('/buscar-productos', [ProductController::class, 'buscar']);

//////////////////////////////////BUSCADOR/////////////////////////////////////


//////////////////////////////////ESPECIFICACIONES/////////////////////////////////////

Route::prefix('panel/especificaciones')->group(function () {
    // Ruta para seleccionar un producto
    Route::get('/seleccionar-producto', [EspecificacionController::class, 'seleccionarProducto'])->name('panel.especificaciones.seleccionar_producto');

    // Ruta para mostrar las especificaciones de un producto (requiere producto_id)
    Route::get('/{producto_id}', [EspecificacionController::class, 'index'])->name('panel.especificaciones.index');

    // Ruta para mostrar el formulario de creación de especificaciones (requiere producto_id)
    Route::get('/create/{producto_id}', [EspecificacionController::class, 'create'])->name('panel.especificaciones.create');

    // Ruta para guardar una nueva especificación (requiere producto_id)
    Route::post('/store/{producto_id}', [EspecificacionController::class, 'store'])->name('panel.especificaciones.store');

    // Ruta para mostrar el formulario de edición de una especificación (requiere id)
    Route::get('/edit/{id}', [EspecificacionController::class, 'edit'])->name('panel.especificaciones.edit');

    // Ruta para actualizar una especificación existente (requiere id)
    Route::put('/update/{id}', [EspecificacionController::class, 'update'])->name('panel.especificaciones.update');

    // Ruta para eliminar una especificación (requiere id)
    Route::delete('/destroy/{id}', [EspecificacionController::class, 'destroy'])->name('panel.especificaciones.destroy');

    // Ruta para importar especificaciones desde Excel (requiere producto_id)
    Route::post('/importar/{producto_id}', [EspecificacionController::class, 'importar'])->name('panel.especificaciones.importar');
});

//////////////////////////////////ESPECIFICACIONES/////////////////////////////////////


//////////////////////////////////FOOTER/////////////////////////////////////

Route::get('/metodos-pago', function () {
    return view('footer.informacion.metodos-pago');
})->name('footer.metodos-pago');

Route::get('/mision-vision', function () {
    return view('footer.informacion.mision-vision');
})->name('footer.mision-vision');

Route::get('/politicas-privacidad', function () {
    return view('footer.informacion.politicas-privacidad');
})->name('footer.politicas-privacidad');

Route::get('/preguntas-frecuentes', function () {
    return view('footer.informacion.preguntas-frecuentes');
})->name('footer.preguntas-frecuentes');

Route::get('/quienes-somos', function () {
    return view('footer.informacion.quienes-somos');
})->name('footer.quienes-somos');

Route::get('/politica-envio-recojo', function () {
    return view('footer.atencion-cliente.politica-envio-recojo');
})->name('footer.politica-envio-recojo');

Route::get('/terminos-condiciones-garantia', function () {
    return view('footer.atencion-cliente.terminos-condiciones-garantia');
})->name('footer.terminos-condiciones');

Route::get('/terminos-garantia', function () {
    return view('footer.atencion-cliente.terminos-garantia');
})->name('footer.terminos-garantia');

/////////////////////////////////////////////FOOTER/////////////////////////////////////

require __DIR__ . '/admin.php';
