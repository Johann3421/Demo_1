@extends('layouts.admin')
<!-- resources/views/panel/configuracion.blade.php -->

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Configuración del Sistema</h2>

    <div class="row">
        <!-- Tarjeta: Precio del Dólar -->
        <div class="col-md-4 mb-4">
            <div class="config-card">
                <div class="config-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Precio del Dólar</h5>
                    <p class="text-muted">Cambia el precio del dólar en tiempo real.</p>
                    <h3 id="precioDolar">S/ {{ $precio_dolar }}</h3>
                    <button id="actualizarDolar" class="btn btn-primary">Actualizar</button>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Configuración de Imagen Medio -->
        <div class="col-md-4 mb-4">
            <div class="config-card">
                <div class="config-icon bg-warning">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Imagen de Anuncio Medio</h5>
                    <p class="text-muted">Cambia la imagen y el enlace de la parte media.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    function actualizarPrecioDolar() {
        fetch("{{ route('actualizar.dolar') }}")
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('precioDolar').textContent = "S/ " + data.precio;
                document.getElementById('precioDolarHeader').textContent = "S/ " + data.precio;
            } else {
                alert('Error al obtener el precio');
            }
        })
        .catch(error => console.error("Error:", error));
    }

    document.getElementById('actualizarDolar').addEventListener('click', actualizarPrecioDolar);
});
</script>

@endsection