@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Seleccionar Producto</h1>
    <div class="card">
        <div class="card-body">
            <form method="GET" id="seleccionarProductoForm">
                <div class="mb-3">
                    <label for="producto_id" class="form-label">Seleccione un producto:</label>
                    <select name="producto_id" id="producto_id" class="form-select" required>
                        <option value="" disabled selected>Seleccione un producto</option>
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
    document.getElementById('seleccionarProductoForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe automáticamente

        const productoId = document.getElementById('producto_id').value;
        if (!productoId) {
            alert('Por favor, seleccione un producto.');
            return;
        }

        // Redirigir a la ruta con el producto_id
        window.location.href = "{{ url('panel/especificaciones') }}/" + productoId;
    });
</script>
@endsection
