@extends('layouts.app')

@section('title', $producto['nombre'] . ' - Tienda Kenya')

@section('meta-description', $producto['descripcion'])

@section('content')
<div class="container product-page">
    <div class="row">
        <!-- 📷 Galería de imágenes -->
        <div class="product-gallery">
            <div class="product-main-image">
                <img src="{{ asset('images/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }}">
            </div>
            <div class="product-thumbnails">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 1">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 2">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 3">
            </div>
        </div>

        <!-- 📄 Información del producto -->
        <div class="product-info">
            <h1 class="product-title">{{ $producto['nombre'] }}</h1>
            <meta itemprop="brand" content="{{ $producto['marca'] }}">
            <meta itemprop="description" content="{{ $producto['descripcion'] }}">
            <meta itemprop="sku" content="{{ $producto['id'] }}">

            <p class="product-description">{{ $producto['descripcion'] }}</p>
            <p class="product-price"><strong>Precio:</strong> <span>${{ number_format((float) $producto['precio'], 2) }}</span></p>

            <!-- 🛠 Información adicional -->
            <div class="product-additional-info">
                <p><strong>Garantía:</strong> {{ $producto['garantia'] ?? '12 meses' }}</p>
                <p><strong>Disponibilidad:</strong> <span class="stock-status">{{ $producto['stock'] > 0 ? 'En stock' : 'Agotado' }}</span></p>
                <p><strong>Envío:</strong> Gratis a todo el país</p>
                <p><strong>Devoluciones:</strong> 30 días de garantía de devolución</p>
            </div>

            <div class="product-buttons">
                <button class="btn btn-primary add-to-cart" data-id="{{ $id }}">
                    <i class="fas fa-shopping-cart"></i> Añadir al Carrito
                </button>
                <button class="btn btn-outline-danger add-to-favorites" data-id="{{ $id }}">
                    <i class="fas fa-heart"></i> Favorito
                </button>
            </div>
        </div>
    </div>

    <!-- 🛠 Especificaciones Técnicas -->
    <div class="product-specs mt-4">
        <h2>Especificaciones Técnicas</h2>
        <div class="row">
            <div class="col-md-6"><strong>Marca:</strong> {{ $producto['marca'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Modelo:</strong> {{ $producto['modelo'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Procesador:</strong> {{ $producto['procesador'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Memoria RAM:</strong> {{ $producto['ram'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Almacenamiento:</strong> {{ $producto['almacenamiento'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Pantalla:</strong> {{ $producto['pantalla'] ?? 'N/A' }}</div>
            <div class="col-md-6"><strong>Gráficos:</strong> {{ $producto['graficos'] ?? 'N/A' }}</div>
        </div>
    </div>

    <!-- ⭐ Reseñas -->
    <div class="product-reviews mt-5">
        <h2>Reseñas de Usuarios</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="review-card">
                    <h3>Juan Pérez</h3>
                    <p>¡Excelente producto! Lo recomiendo totalmente.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="review-card">
                    <h3>María Gómez</h3>
                    <p>Muy buena calidad, cumple con todas mis expectativas.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // ✅ Scroll automático al cuadro del producto si hay un parámetro en la URL
    document.addEventListener("DOMContentLoaded", function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has("producto")) {
            document.getElementById("product-detail").scrollIntoView({
                behavior: "smooth"
            });
        }
    });

    // ✅ Cambio de imagen principal al hacer clic en una miniatura
    document.querySelectorAll('.thumb').forEach(thumb => {
        thumb.addEventListener('click', function() {
            document.querySelector('.product-main-image img').src = this.src;
        });
    });
</script>
@endsection