@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <!-- Encabezado optimizado -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Gestión de Productos</h1>
        <a href="{{ route('panel.productos.crear') }}" class="btn btn-primary" aria-label="Crear nuevo producto">
            <i class="fas fa-plus me-2" aria-hidden="true"></i> Nuevo producto
        </a>
    </div>

    <!-- Filtros optimizados con accesibilidad -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-3 gap-3">
        <form method="GET" action="{{ route('panel.productos') }}" class="d-flex flex-column flex-md-row align-items-center gap-3 w-100" id="searchForm">
            <div class="input-group flex-grow-1" style="max-width: 400px;">
                <span class="input-group-text bg-white">
                    <i class="fas fa-search text-muted" aria-hidden="true"></i>
                </span>
                <input type="text"
                       name="search"
                       id="searchInput"
                       class="form-control"
                       placeholder="Buscar productos..."
                       value="{{ $search ?? '' }}"
                       autocomplete="off"
                       aria-label="Buscar productos">
                <button type="button" class="btn btn-outline-secondary" id="clearSearch" aria-label="Limpiar búsqueda">
                    <i class="fas fa-times" aria-hidden="true"></i>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <label for="perPage" class="me-2 mb-0">Mostrar:</label>
                <select name="perPage" id="perPage" class="form-select form-select-sm" aria-label="Elementos por página">
                    @foreach ($perPageOptions as $option)
                    <option value="{{ $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Tabla optimizada con responsive y accesibilidad -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h2 class="h5 mb-0">Lista de Productos</h2>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-bordered table-hover mb-0" id="productsTable" aria-describedby="productsTableDesc">
                    <caption id="productsTableDesc" class="visually-hidden">Tabla de productos con sus precios, stock y acciones</caption>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col" class="w-30">Nombre</th>
                            <th scope="col">Precio (USD)</th>
                            <th scope="col">Precio (PEN)</th>
                            <th scope="col">Stock</th>
                            <th scope="col" class="text-center">Visible</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @forelse ($productos as $producto)
                        <tr class="product-row align-middle" data-id="{{ $producto->id }}">
                            <td class="searchable" data-label="Nombre">{{ $producto->nombre }}</td>
                            <td data-label="Precio USD">${{ number_format($producto->precio_dolares, 2) }}</td>
                            <td data-label="Precio PEN">S/{{ number_format($producto->precio_soles, 2) }}</td>
                            <td data-label="Stock">{{ $producto->stock }}</td>
                            <td class="text-center" data-label="Visible">
                                <div class="form-check form-switch d-inline-block">
                                    <input type="checkbox"
                                           class="form-check-input visibility-toggle"
                                           data-id="{{ $producto->id }}"
                                           id="visibility-{{ $producto->id }}"
                                           {{ $producto->visible ? 'checked' : '' }}
                                           style="width: 3em; height: 1.5em;">
                                    <label for="visibility-{{ $producto->id }}" class="visually-hidden">Visibilidad del producto</label>
                                </div>
                                <span class="badge bg-{{ $producto->visible ? 'success' : 'danger' }} ms-2">
                                    {{ $producto->visible ? 'Sí' : 'No' }}
                                </span>
                            </td>
                            <td class="text-center" data-label="Acciones">
                                <div class="btn-group btn-group-sm" role="group" aria-label="Acciones del producto">
                                    <a href="{{ route('panel.productos.editar', $producto->id) }}"
                                       class="btn btn-primary"
                                       aria-label="Editar producto"
                                       title="Editar">
                                        <i class="fas fa-edit" aria-hidden="true"></i>
                                    </a>
                                    <button class="btn btn-danger btn-eliminar"
                                            data-id="{{ $producto->id }}"
                                            data-url="{{ route('panel.productos.eliminar', $producto->id) }}"
                                            aria-label="Eliminar producto"
                                            title="Eliminar">
                                        <i class="fas fa-trash-alt" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">No se encontraron productos</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación optimizada -->
            @if($productos->hasPages())
            <div class="d-flex justify-content-center p-3">
                {{ $productos->appends([
                    'search' => request('search'),
                    'perPage' => request('perPage')
                ])->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>


<style>
    /* Estilos optimizados */
    #searchInput {
        transition: all 0.3s ease;
    }

    #searchInput:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }

    #clearSearch {
        transition: opacity 0.3s ease;
        opacity: 0.7;
    }

    #clearSearch:hover {
        opacity: 1;
    }
</style>
<script src="{{ asset('js/admin-productos-view.js') }}"></script>
@endsection
