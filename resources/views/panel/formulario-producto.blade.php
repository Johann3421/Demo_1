@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary fw-bold">{{ isset($producto) ? 'Editar Producto' : 'Crear Nuevo Producto' }}</h1>
        <a href="{{ route('panel.productos') }}" class="btn btn-secondary" aria-label="Volver al listado de productos">
            <i class="fas fa-arrow-left me-2" aria-hidden="true"></i> Volver
        </a>
    </div>

    <div class="card shadow-lg">
        <div class="card-body">
            <form action="{{ isset($producto) ? route('panel.productos.actualizar', $producto->id) : route('panel.productos.guardar') }}"
                  method="POST"
                  enctype="multipart/form-data"
                  id="producto-form">
                @csrf
                @if (isset($producto))
                    @method('PUT')
                @endif

                <div class="row row-cols-md-2 g-4">
                    <!-- Nombre y Slug -->
                    <div class="col">
                        <label for="nombre" class="form-label fw-bold">Nombre del Producto</label>
                        <input type="text" name="nombre" id="nombre" class="form-control"
                            value="{{ old('nombre', $producto->nombre ?? '') }}"
                            required
                            maxlength="255"
                            oninput="document.getElementById('slug').value = slugify(this.value)">
                    </div>
                    <div class="col">
                        <label for="slug" class="form-label fw-bold">Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control"
                            value="{{ old('slug', $producto->slug ?? '') }}"
                            required
                            maxlength="255">
                    </div>

                    <!-- Imagen (Drag & Drop optimizado) -->
                    <div class="col text-center">
                        <label for="imagen_url" class="form-label fw-bold d-block">Imagen del Producto</label>
                        <div id="drop-zone"
                             class="border rounded p-4 bg-light text-center cursor-pointer"
                             role="button"
                             aria-label="Área para subir imagen"
                             tabindex="0">
                            <p class="mb-0">Arrastra una imagen aquí o haz clic para seleccionar</p>
                            <input type="file"
                                   name="imagen_url"
                                   id="imagen_url"
                                   class="form-control d-none"
                                   accept="image/*"
                                   aria-describedby="imageHelp">
                            <img id="vista_previa"
                                src="{{ isset($producto) && $producto->imagen_url ? asset('images/' . $producto->imagen_url) : asset('images/default.png') }}"
                                class="img-thumbnail mt-3"
                                style="max-width: 200px; height: auto;"
                                alt="Vista previa de la imagen del producto"
                                loading="lazy">
                            <div id="imageHelp" class="form-text">Tamaño recomendado: 800x800px</div>
                        </div>
                    </div>

                    <!-- Descripción y Características -->
                    <div class="col">
                        <label for="descripcion" class="form-label fw-bold">Descripción</label>
                        <textarea name="descripcion"
                                  id="descripcion"
                                  class="form-control"
                                  rows="4"
                                  style="resize: none;"
                                  maxlength="1000">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
                    </div>
                    <div class="col">
                        <label for="caracteristicas" class="form-label fw-bold">Características</label>
                        <textarea name="caracteristicas"
                                  id="caracteristicas"
                                  class="form-control"
                                  rows="4"
                                  style="resize: none;"
                                  maxlength="1000">{{ old('caracteristicas', $producto->caracteristicas ?? '') }}</textarea>
                    </div>

                    <!-- Precios con validación -->
                    <div class="col">
                        <label for="precio_dolares" class="form-label fw-bold">Precio en Dólares (USD)</label>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="precio_dolares"
                                   id="precio_dolares"
                                   class="form-control"
                                   value="{{ old('precio_dolares', $producto->precio_dolares ?? '0.00') }}"
                                   required
                                   onchange="calcularPrecioSoles(this.value)">
                        </div>
                    </div>
                    <div class="col">
                        <label for="precio_soles" class="form-label fw-bold">Precio en Soles (PEN)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/</span>
                            <input type="number"
                                   step="0.01"
                                   min="0"
                                   name="precio_soles"
                                   id="precio_soles"
                                   class="form-control"
                                   value="{{ old('precio_soles', $producto->precio_soles ?? '0.00') }}"
                                   required
                                   onchange="calcularPrecioDolares(this.value)">
                        </div>
                    </div>

                    <!-- Marca y Modelo -->
                    <div class="col">
                        <label for="marca" class="form-label fw-bold">Marca</label>
                        <input type="text"
                               name="marca"
                               id="marca"
                               class="form-control"
                               value="{{ old('marca', $producto->marca ?? '') }}"
                               maxlength="100">
                    </div>
                    <div class="col">
                        <label for="modelo" class="form-label fw-bold">Modelo</label>
                        <input type="text"
                               name="modelo"
                               id="modelo"
                               class="form-control"
                               value="{{ old('modelo', $producto->modelo ?? '') }}"
                               maxlength="100">
                    </div>

                    <!-- Stock y Descuento -->
                    <div class="col">
                        <label for="stock" class="form-label fw-bold">Stock</label>
                        <input type="number"
                               name="stock"
                               id="stock"
                               class="form-control"
                               value="{{ old('stock', $producto->stock ?? '0') }}"
                               required
                               min="0">
                    </div>
                    <div class="col">
                        <label for="descuento" class="form-label fw-bold">Descuento (%)</label>
                        <input type="number"
                               name="descuento"
                               id="descuento"
                               class="form-control"
                               value="{{ old('descuento', $producto->descuento ?? '0') }}"
                               min="0"
                               max="100">
                    </div>

                    <!-- Categoría con carga optimizada -->
                    <div class="col">
                        <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                        <select name="categoria_id"
                                id="categoria_id"
                                class="form-control select2"
                                required
                                data-placeholder="Seleccione una categoría">
                            <option value=""></option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    {{ old('categoria_id', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Grupo con carga condicional -->
                    <div class="col">
                        <label for="grupo_id" class="form-label fw-bold">Grupo</label>
                        <select name="grupo_id"
                                id="grupo_id"
                                class="form-control select2"
                                data-placeholder="Seleccione un grupo">
                            <option value=""></option>
                            @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id }}"
                                    {{ old('grupo_id', $producto->grupo_id ?? '') == $grupo->id ? 'selected' : '' }}>
                                    {{ $grupo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Subgrupo con carga condicional -->
                    <div class="col">
                        <label for="subgrupo_id" class="form-label fw-bold">Subgrupo</label>
                        <select name="subgrupo_id"
                                id="subgrupo_id"
                                class="form-control select2"
                                data-placeholder="Seleccione un subgrupo">
                            <option value=""></option>
                            @foreach ($subgrupos as $subgrupo)
                                <option value="{{ $subgrupo->id }}"
                                    {{ old('subgrupo_id', $producto->subgrupo_id ?? '') == $subgrupo->id ? 'selected' : '' }}>
                                    {{ $subgrupo->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Botón de submit optimizado -->
                <div class="d-flex justify-content-end mt-4">
                    <button type="submit"
                            class="btn btn-primary btn-lg"
                            id="submit-btn">
                        <i class="fas fa-save me-2" aria-hidden="true"></i>
                        {{ isset($producto) ? 'Actualizar Producto' : 'Crear Producto' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
    <script src="{{ asset('js/admin-productos.js') }}"></script>
@endsection
