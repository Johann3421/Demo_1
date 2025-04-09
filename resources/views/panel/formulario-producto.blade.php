@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">{{ isset($producto) ? 'Editar Producto' : 'Crear Nuevo Producto' }}</h1>
            <a href="{{ route('panel.productos') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ isset($producto) ? route('panel.productos.actualizar', $producto->id) : route('panel.productos.guardar') }}"
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($producto)) @method('PUT') @endif

                    <div class="row row-cols-md-2 g-4">
                        <!-- Nombre y Slug -->
                        <div class="col">
                            <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                   value="{{ old('nombre', $producto->nombre ?? '') }}" required>
                        </div>
                        <div class="col">
                            <label for="slug" class="form-label fw-bold">Slug</label>
                            <input type="text" name="slug" id="slug" class="form-control"
                                   value="{{ old('slug', $producto->slug ?? '') }}" required>
                        </div>

                        <!-- Imagen (Drag & Drop) -->
                        <div class="col text-center">
                            <label class="form-label fw-bold d-block">Imagen del Producto</label>
                            <div id="drop-zone" class="border rounded p-4 bg-light text-center cursor-pointer">
                                <p class="mb-0">Arrastra una imagen aquí o haz clic para seleccionar</p>
                                <input type="file" name="imagen_url" id="imagen_url" class="form-control d-none" accept="image/*">
                                <img id="vista_previa"
                                    src="{{ isset($producto) && $producto->imagen_url ? asset('images/' . $producto->imagen_url) : asset('images/default.png') }}"
                                    class="img-thumbnail mt-3" style="max-width: 200px; height: auto;">
                            </div>
                        </div>

                        <!-- Descripción y Características -->
                        <div class="col">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="4" style="resize: none;">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                        </div>
                        <div class="col">
                            <label for="caracteristicas" class="form-label fw-bold">Características</label>
                            <textarea name="caracteristicas" id="caracteristicas" class="form-control" rows="4" style="resize: none;">{{ old('caracteristicas', $producto->caracteristicas ?? '') }}</textarea>
                        </div>

                        <!-- Precios -->
                        <div class="col">
                            <label for="precio_dolares" class="form-label fw-bold">Precio en Dólares (USD)</label>
                            <input type="number" step="0.01" name="precio_dolares" id="precio_dolares" class="form-control"
                                   value="{{ old('precio_dolares', $producto->precio_dolares ?? '') }}" required>
                        </div>
                        <div class="col">
                            <label for="precio_soles" class="form-label fw-bold">Precio en Soles (PEN)</label>
                            <input type="number" step="0.01" name="precio_soles" id="precio_soles" class="form-control"
                                   value="{{ old('precio_soles', $producto->precio_soles ?? '') }}" required>
                        </div>

                        <!-- Marca y Modelo -->
                        <div class="col">
                            <label for="marca" class="form-label fw-bold">Marca</label>
                            <input type="text" name="marca" id="marca" class="form-control" value="{{ old('marca', $producto->marca ?? '') }}">
                        </div>
                        <div class="col">
                            <label for="modelo" class="form-label fw-bold">Modelo</label>
                            <input type="text" name="modelo" id="modelo" class="form-control" value="{{ old('modelo', $producto->modelo ?? '') }}">
                        </div>

                        <!-- Stock y Descuento -->
                        <div class="col">
                            <label for="stock" class="form-label fw-bold">Stock</label>
                            <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock', $producto->stock ?? '') }}" required>
                        </div>
                        <div class="col">
                            <label for="descuento" class="form-label fw-bold">Descuento (%)</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" value="{{ old('descuento', $producto->descuento ?? '') }}">
                        </div>

                        <!-- Categoría -->
                        <div class="col">
                            <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ (isset($producto) && $producto->categoria_id == $categoria->id) ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Grupo -->
                        <div class="col">
                            <label for="grupo_id" class="form-label fw-bold">Grupo</label>
                            <select name="grupo_id" id="grupo_id" class="form-control">
                                <option value="">Seleccione un grupo</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}"
                                        {{ (isset($producto) && $producto->grupo_id == $grupo->id) ? 'selected' : '' }}>
                                        {{ $grupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Subgrupo -->
                        <div class="col">
                            <label for="subgrupo_id" class="form-label fw-bold">Subgrupo</label>
                            <select name="subgrupo_id" id="subgrupo_id" class="form-control">
                                <option value="">Seleccione un subgrupo</option>
                                @foreach ($subgrupos as $subgrupo)
                                    <option value="{{ $subgrupo->id }}"
                                        {{ (isset($producto) && $producto->subgrupo_id == $subgrupo->id) ? 'selected' : '' }}>
                                        {{ $subgrupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Botón para añadir especificaciones -->
                    <div class="d-flex justify-content-end mt-4">
                        <button type="button" id="btn-especificaciones" class="btn btn-outline-primary me-3">
                            <i class="fas fa-plus me-2"></i>Añadir Especificaciones
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>{{ isset($producto) ? 'Actualizar Producto' : 'Crear Producto' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/admin-productos.js') }}"></script>
@endsection
