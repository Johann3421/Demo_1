@extends('layouts.app')

@section('title', $producto['nombre'] . ' - ' . $producto['marca'] . ' | SEKAITECH')

@section('meta-description', 'Compra el ' . $producto['nombre'] . ' de ' . $producto['marca'] . ' al mejor precio en SEKAITECH. ' . $producto['descripcion'])

@section('content')
<div class="container product-page">
    <div class="row">
        <!-- 📷 Galería de imágenes -->
        <div class="product-gallery">
            <div class="product-main-image">
                <img src="{{ asset('images/' . $producto['imagen']) }}" alt="{{ $producto['nombre'] }} - {{ $producto['marca'] }}">
            </div>
            <div class="product-thumbnails">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 1 - {{ $producto['nombre'] }}">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 2 - {{ $producto['nombre'] }}">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="thumb" alt="Miniatura 3 - {{ $producto['nombre'] }}">
            </div>
        </div>

        <!-- 📄 Información del producto -->
        <div class="product-info">
            <h1 class="product-title">{{ $producto['nombre'] }}</h1>
            <meta itemprop="brand" content="{{ $producto['marca'] }}">
            <meta itemprop="description" content="{{ $producto['descripcion'] }}">
            <meta itemprop="sku" content="{{ $producto['id'] }}">

            <p class="product-description">{{ $producto['descripcion'] }}</p>
<p class="product-price" style="color: red; font-size: 1.8rem; font-weight: bold;">
    <strong>Precio en dólares:</strong> ${{ number_format($producto['precio'], 2) }}
</p>
<p class="product-price" style="color: green; font-size: 1.8rem; font-weight: bold;">
    <strong>Precio en soles:</strong> S/.{{ number_format($producto['precio_soles'], 2) }}
</p>


            <!-- 🛠 Información adicional -->
            <div class="product-additional-info">
                <p><strong>Garantía:</strong> {{ $producto['garantia'] ?? '12 meses' }}</p>
                <p><strong>Disponibilidad:</strong> <span class="stock-status">{{ $producto['stock'] > 0 ? 'En stock' : 'Agotado' }}</span></p>
                <p><strong>Envío:</strong> Gratis a todo el país</p>
                <p><strong>Devoluciones:</strong> 30 días de garantía de devolución</p>
            </div>

            <div class="product-buttons">
                <a href="https://wa.me/51933573985?text=Hola,%20estoy%20interesado%20en%20el%20producto%20{{ urlencode($producto['nombre']) }}%20-%20Precio:%20${{ number_format((float) $producto['precio'], 2) }}" class="btn btn-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
                <button class="btn btn-outline-primary like-button" data-id="{{ $id }}">
                    <i class="fas fa-thumbs-up"></i> <span class="like-count">0</span> Likes
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

<!-- Schema Markup para SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $producto['nombre'] }}",
  "description": "{{ $producto['descripcion'] }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $producto['marca'] }}"
  },
  "image": "{{ asset('images/' . $producto['imagen']) }}",
  "offers": {
    "@type": "Offer",
    "price": "{{ $producto['precio'] }}",
    "priceCurrency": "USD",
    "availability": "{{ $producto['stock'] > 0 ? 'InStock' : 'OutOfStock' }}",
    "seller": {
      "@type": "Organization",
      "name": "SEKAITECH"
    }
  }
}
</script>

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

    // ✅ Funcionalidad de Likes
    document.querySelector('.like-button').addEventListener('click', function() {
        const productId = this.dataset.id;
        const likeCountElement = this.querySelector('.like-count');
        let likeCount = parseInt(likeCountElement.textContent);

        // Simular la acción de dar like (puedes implementar una llamada AJAX aquí)
        likeCount += 1;
        likeCountElement.textContent = likeCount;

        // Deshabilitar el botón después de dar like
        this.disabled = true;
        this.classList.add('disabled');
    });
</script>
@endsection