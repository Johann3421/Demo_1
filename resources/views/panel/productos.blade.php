@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Productos</h1>
        <a href="{{ route('panel.productos.crear') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Crear nuevo producto
        </a>
    </div>

    <!-- Filtros y controles optimizados -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('panel.productos') }}" class="d-flex align-items-center gap-3" id="searchForm">
            <div class="input-group" style="max-width: 300px;">
                <input type="text" 
                       name="search" 
                       id="searchInput"
                       class="form-control"
                       placeholder="Buscar productos..."
                       value="{{ $search ?? '' }}"
                       autocomplete="off">
                <button type="button" class="btn btn-secondary" id="clearSearch">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="d-flex align-items-center">
                <label for="perPage" class="me-2">Mostrar:</label>
                <select name="perPage" id="perPage" class="form-select form-select-sm">
                    @foreach ($perPageOptions as $option)
                    <option value="{{ $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <!-- Tabla de productos optimizada -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Lista de Productos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="productsTable">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio (USD)</th>
                            <th>Precio (PEN)</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        @foreach ($productos as $producto)
                        <tr class="product-row" data-id="{{ $producto->id }}">
                            <td class="searchable">{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio_dolares, 2) }}</td>
                            <td>S/{{ number_format($producto->precio_soles, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                <a href="{{ route('panel.productos.editar', $producto->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <button class="btn btn-sm btn-danger btn-eliminar" 
                                        data-id="{{ $producto->id }}"
                                        data-url="{{ route('panel.productos.eliminar', $producto->id) }}">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $productos->appends([
                    'search' => request('search'),
                    'perPage' => request('perPage')
                ])->links('pagination::bootstrap-5') }}
            </div>
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

<script>
    // Cache de elementos DOM
    const domCache = {
        searchInput: document.getElementById('searchInput'),
        clearSearch: document.getElementById('clearSearch'),
        perPage: document.getElementById('perPage'),
        searchForm: document.getElementById('searchForm'),
        productsTableBody: document.getElementById('productsTableBody')
    };

    // Función optimizada para aplicar filtro local
    function applyLocalFilter(searchTerm) {
        const rows = domCache.productsTableBody.querySelectorAll('.product-row');
        const term = searchTerm.toLowerCase();
        
        // Usamos requestAnimationFrame para mejor rendimiento
        requestAnimationFrame(() => {
            rows.forEach(row => {
                const text = row.querySelector('.searchable').textContent.toLowerCase();
                row.style.display = text.includes(term) ? '' : 'none';
            });
        });
    }

    // Delegación de eventos para mejor performance
    function setupEventListeners() {
        // Búsqueda en tiempo real con debounce
        let searchTimeout;
        domCache.searchInput.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            applyLocalFilter(searchTerm);
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                domCache.searchForm.submit();
            }, 800);
        });

        // Limpiar búsqueda
        domCache.clearSearch.addEventListener('click', function() {
            domCache.searchInput.value = '';
            domCache.searchForm.submit();
        });

        // Cambiar elementos por página
        domCache.perPage.addEventListener('change', function() {
            domCache.searchForm.submit();
        });

        // Delegación de eventos para los botones de eliminar
        domCache.productsTableBody.addEventListener('click', function(e) {
            if (e.target.closest('.btn-eliminar')) {
                e.preventDefault();
                const button = e.target.closest('.btn-eliminar');
                const productId = button.getAttribute('data-id');
                const deleteUrl = button.getAttribute('data-url');
                
                handleDeleteProduct(productId, deleteUrl);
            }
        });
    }

    // Función optimizada para manejar eliminación
    async function handleDeleteProduct(productId, deleteUrl) {
        try {
            const result = await Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar!',
                cancelButtonText: 'Cancelar'
            });

            if (result.isConfirmed) {
                const response = await fetch(deleteUrl, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                });

                const data = await response.json();

                if (data.success) {
                    await Swal.fire('Eliminado!', data.message, 'success');
                    // Eliminar la fila directamente sin recargar la página
                    document.querySelector(`.product-row[data-id="${productId}"]`).remove();
                } else {
                    await Swal.fire('Error!', data.message, 'error');
                }
            }
        } catch (error) {
            await Swal.fire('Error!', 'Ocurrió un error al intentar eliminar el producto.', 'error');
            console.error('Error al eliminar producto:', error);
        }
    }

    // Inicialización cuando el DOM está listo
    document.addEventListener('DOMContentLoaded', function() {
        // Aplicar filtro inicial si existe
        if (domCache.searchInput.value) {
            applyLocalFilter(domCache.searchInput.value.toLowerCase());
        }
        
        // Configurar event listeners
        setupEventListeners();
    });
</script>
@endsection