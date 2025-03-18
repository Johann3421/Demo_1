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
                            <th>En Tienda</th>
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
                            <td>
                                <div class="d-flex align-items-center">
                                    <label class="switch">
                                        <input type="checkbox" class="toggle-tienda" data-id="{{ $producto->id }}" {{ $producto->en_tienda ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="estado-tienda ms-2">{{ $producto->en_tienda ? 'Sí' : 'No' }}</span>
                                </div>
                            </td>
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

<!-- Scripts -->
<script>
    // Cambiar el estado de "En tienda"
    document.addEventListener('click', function(event) {
        if (event.target.classList.contains('toggle-tienda')) {
            const productId = event.target.dataset.id;
            const isChecked = event.target.checked;
            const estadoSpan = event.target.closest('td').querySelector('.estado-tienda');

            // Cambiar el texto del estado
            estadoSpan.innerText = isChecked ? 'Sí' : 'No';

            // Aquí puedes hacer una solicitud AJAX para actualizar el estado en la base de datos
            console.log(`Cambiando estado "En tienda" del producto ${productId} a ${isChecked ? 'Sí' : 'No'}`);
        }
    });

    // Eliminar producto (confirmación y solicitud AJAX)
    document.querySelectorAll('.btn-eliminar').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.id;

            // Confirmar antes de eliminar
            if (confirm('¿Estás seguro de eliminar este producto?')) {
                // Aquí puedes hacer una solicitud AJAX para eliminar el producto
                console.log(`Eliminar producto ${productId}`);

                // Redirigir o recargar la página después de eliminar
                window.location.href = "{{ route('panel.productos') }}";
            }
        });
    });
</script>

@endsection