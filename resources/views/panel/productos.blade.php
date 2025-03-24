<!-- resources/views/panel/productos.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Productos</h1>
        <!-- Botón para crear nuevo producto -->
        <a href="{{ route('panel.productos.crear') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i> Crear nuevo producto
        </a>
    </div>

    <!-- Selector de elementos por página -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" action="{{ route('panel.productos') }}" class="d-flex align-items-center">
            <label for="perPage" class="me-2">Mostrar:</label>
            <select name="perPage" id="perPage" class="form-select form-select-sm" onchange="this.form.submit()">
                @foreach ($perPageOptions as $option)
                <option value="{{ $option }}" {{ $perPage == $option ? 'selected' : '' }}>{{ $option }}</option>
                @endforeach
            </select>
        </form>
    </div>

    <!-- Tabla de productos -->
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Lista de Productos</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Nombre</th>
                            <th>Precio (USD)</th>
                            <th>Precio (PEN)</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>${{ number_format($producto->precio_dolares, 2) }}</td>
                            <td>S/{{ number_format($producto->precio_soles, 2) }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>
                                <!-- Botón de editar -->
                                <a href="{{ route('panel.productos.editar', $producto->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <!-- Botón de eliminar -->
                                <button class="btn btn-sm btn-danger btn-eliminar" data-id="{{ $producto->id }}">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación compacta con Bootstrap 5 -->
            <div class="d-flex justify-content-center mt-4">
                {{ $productos->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>


@endsection