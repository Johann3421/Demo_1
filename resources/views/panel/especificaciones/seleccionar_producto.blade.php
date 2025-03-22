@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Seleccionar Producto</h1>
    <div class="card">
        <div class="card-body">
            <!-- resources/views/panel/especificaciones/seleccionar_producto.blade.php -->
            <form action="{{ route('panel.especificaciones.index', ['producto_id' => 'selected_product_id']) }}" method="GET" id="seleccionarProductoForm">
    <div class="mb-3">
        <label for="producto_id" class="form-label">Seleccione un producto:</label>
        <select name="producto_id" id="producto_id" class="form-select" required>
            @foreach($productos as $producto)
                <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Continuar</button>
</form>

        </div>
    </div>
</div>

<script>
    // Actualizar el formulario para enviar el producto_id seleccionado
    document.getElementById('seleccionarProductoForm').addEventListener('submit', function(event) {
        const productoId = document.getElementById('producto_id').value;
        this.action = this.action.replace('selected_product_id', productoId);
    });
</script>
@endsection