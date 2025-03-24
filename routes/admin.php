<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\FiltroController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubFiltroController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;

// Rutas protegidas por autenticación
Route::middleware(['auth'])->prefix('panel')->group(function () {
    // Ruta principal del panel
    Route::get('/', [PanelController::class, 'index'])->name('panel.index');

    // Rutas de productos en el panel
    Route::get('/productos', [PanelController::class, 'productos'])->name('panel.productos');
    Route::get('/productos/crear', [PanelController::class, 'mostrarFormularioCrear'])->name('panel.productos.crear');
    Route::post('/productos/guardar', [PanelController::class, 'guardarProducto'])->name('panel.productos.guardar');
    Route::get('/productos/editar/{id}', [PanelController::class, 'mostrarFormularioEditar'])->name('panel.productos.editar');
    Route::put('/productos/actualizar/{id}', [PanelController::class, 'actualizarProducto'])->name('panel.productos.actualizar');
    Route::delete('/productos/eliminar/{id}', [PanelController::class, 'eliminarProducto'])->name('panel.productos.eliminar');

    // Rutas de categorías en el panel
    Route::get('/categorias', [CategoriaController::class, 'panelIndex'])->name('panel.categorias');
    Route::get('/categorias/crear', [CategoriaController::class, 'crear'])->name('panel.categorias.crear');
    Route::post('/categorias/guardar', [CategoriaController::class, 'guardar'])->name('panel.categorias.guardar');
    Route::get('/categorias/editar/{id}', [CategoriaController::class, 'editar'])->name('panel.categorias.editar');
    Route::put('/categorias/actualizar/{id}', [CategoriaController::class, 'actualizar'])->name('panel.categorias.actualizar');
    Route::delete('/categorias/eliminar/{id}', [CategoriaController::class, 'eliminar'])->name('panel.categorias.eliminar');

    // Otras secciones del panel
    Route::get('/filtros', [PanelController::class, 'filtros'])->name('panel.filtros');
    Route::get('/banners', [PanelController::class, 'banners'])->name('panel.banners');
    Route::get('/configuracion', [PanelController::class, 'configuracion'])->name('panel.configuracion');
    // Nueva ruta para Proveedores
    Route::get('/proveedores', [PanelController::class, 'proveedores'])->name('panel.proveedores');
});

// Rutas de autenticación
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

//////////////////////////////////FILTROS/////////////////////////////////////

// Filtros
Route::get('/panel/filtros', [FiltroController::class, 'index'])->name('panel.filtros');

// Grupos
Route::get('/panel/filtros/grupos/crear', [FiltroController::class, 'crearGrupo'])->name('panel.filtros.grupos.crear');
Route::post('/panel/filtros/grupos/guardar', [FiltroController::class, 'guardarGrupo'])->name('panel.filtros.grupos.guardar');
Route::get('/panel/filtros/grupos/editar/{id}', [FiltroController::class, 'editarGrupo'])->name('panel.filtros.grupos.editar');
Route::put('/panel/filtros/grupos/actualizar/{id}', [FiltroController::class, 'actualizarGrupo'])->name('panel.filtros.grupos.actualizar');
Route::delete('/panel/filtros/grupos/eliminar/{id}', [FiltroController::class, 'eliminarGrupo'])->name('panel.filtros.grupos.eliminar');

// Subgrupos
Route::get('/panel/filtros/subgrupos/crear', [FiltroController::class, 'crearSubgrupo'])->name('panel.filtros.subgrupos.crear');
Route::post('/panel/filtros/subgrupos/guardar', [FiltroController::class, 'guardarSubgrupo'])->name('panel.filtros.subgrupos.guardar');
Route::get('/panel/filtros/subgrupos/editar/{id}', [FiltroController::class, 'editarSubgrupo'])->name('panel.filtros.subgrupos.editar');
Route::put('/panel/filtros/subgrupos/actualizar/{id}', [FiltroController::class, 'actualizarSubgrupo'])->name('panel.filtros.subgrupos.actualizar');
Route::delete('/panel/filtros/subgrupos/eliminar/{id}', [FiltroController::class, 'eliminarSubgrupo'])->name('panel.filtros.subgrupos.eliminar');


//////////////////////////////////FILTROS/////////////////////////////////////


//////////////////////////////////GRUPOS/////////////////////////////////////
// Rutas para obtener grupos y subgrupos filtrados
Route::get('/panel/grupos-por-categoria/{categoria_id}', [PanelController::class, 'obtenerGruposPorCategoria']);
Route::get('/panel/subgrupos-por-grupo/{grupo_id}', [PanelController::class, 'obtenerSubgruposPorGrupo']);
//////////////////////////////////GRUPOS/////////////////////////////////////

//////////////////////////////////BANNERS/////////////////////////////////////

// Rutas de banners en el panel
Route::get('/panel/banners', [SliderController::class, 'index'])->name('panel.banners');
Route::get('/panel/banners/crear', [SliderController::class, 'crear'])->name('panel.banners.crear');
Route::post('/panel/banners/guardar', [SliderController::class, 'guardar'])->name('panel.banners.guardar');
Route::get('/panel/banners/editar/{id}', [SliderController::class, 'editar'])->name('panel.banners.editar');
Route::put('/panel/banners/actualizar/{id}', [SliderController::class, 'actualizar'])->name('panel.banners.actualizar');
Route::delete('/panel/banners/eliminar/{id}', [SliderController::class, 'eliminar'])->name('panel.banners.eliminar');


//////////////////////////////////BANNERS/////////////////////////////////////


//////////////////////////////////PROVEEDORES/////////////////////////////////////

// Rutas de Proveedores en el panel
Route::get('/proveedores', [ProveedorController::class, 'index'])->name('panel.proveedores');
Route::get('/proveedores/crear', [ProveedorController::class, 'create'])->name('panel.proveedores.crear');
Route::post('/proveedores/guardar', [ProveedorController::class, 'store'])->name('panel.proveedores.guardar');
Route::get('/proveedores/editar/{id}', [ProveedorController::class, 'edit'])->name('panel.proveedores.editar');
Route::put('/proveedores/actualizar/{id}', [ProveedorController::class, 'update'])->name('panel.proveedores.actualizar');
Route::delete('/proveedores/eliminar/{id}', [ProveedorController::class, 'destroy'])->name('panel.proveedores.eliminar');


//////////////////////////////////PROVEEDORES/////////////////////////////////////


//////////////////////////////////SUBFILTROS/////////////////////////////////////


Route::prefix('panel')->group(function () {
    // Mostrar la vista principal
    Route::get('/subfiltro', [SubFiltroController::class, 'index'])->name('panel.subfiltro');

    // Sub-Filtros
    Route::get('/subfiltro/crear-subfiltro', [SubFiltroController::class, 'mostrarFormularioSubFiltro'])->name('panel.subfiltro.crear.subfiltro');
    Route::get('/subfiltro/editar-subfiltro/{id}', [SubFiltroController::class, 'mostrarFormularioSubFiltro'])->name('panel.subfiltro.editar.subfiltro');
    Route::post('/subfiltro/guardar-subfiltro/{id?}', [SubFiltroController::class, 'guardarSubFiltro'])->name('panel.subfiltro.guardar.subfiltro');
    Route::delete('/subfiltro/eliminar-subfiltro/{id}', [SubFiltroController::class, 'eliminarSubFiltro'])->name('panel.subfiltro.eliminar.subfiltro');

    // Opciones
    Route::get('/subfiltro/crear-opcion', [SubFiltroController::class, 'mostrarFormularioOpcion'])->name('panel.subfiltro.crear.opcion');
    Route::get('/subfiltro/editar-opcion/{id}', [SubFiltroController::class, 'mostrarFormularioOpcion'])->name('panel.subfiltro.editar.opcion');
    Route::post('/subfiltro/guardar-opcion/{id?}', [SubFiltroController::class, 'guardarOpcion'])->name('panel.subfiltro.guardar.opcion');
    Route::delete('/subfiltro/eliminar-opcion/{id}', [SubFiltroController::class, 'eliminarOpcion'])->name('panel.subfiltro.eliminar.opcion');
});

Route::get('/panel/subfiltros/buscar', [SubFiltroController::class, 'buscarSubFiltros'])->name('subfiltros.buscar');

//////////////////////////////////SUBFILTROS/////////////////////////////////////

//////////////////////////////////DOLAR////////////////////////////////////
Route::get('/configuracion', [ConfiguracionController::class, 'index'])->name('configuracion.index');
Route::get('/actualizar-dolar', [ConfiguracionController::class, 'actualizarDolar'])->name('actualizar.dolar');

//////////////////////////////////DOLAR////////////////////////////////////