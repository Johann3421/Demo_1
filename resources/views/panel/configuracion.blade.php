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
@endsection
