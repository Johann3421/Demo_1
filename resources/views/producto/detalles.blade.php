@extends('layouts.app', ['ocultarSlider' => true])


@section('title', $producto->nombre . ' - ' . $producto->marca . ' | SEKAITECH')

@section('meta-description', 'Compra el ' . $producto->nombre . ' de ' . $producto->marca . ' al mejor precio en SEKAITECH. ' . $producto->descripcion)

@section('content')
<div class="container product-page">
    <div class="product-container">
        <!-- 📷 Imagen del producto -->
        <div class="product-gallery">
            <div class="product-main-image">
                <img src="{{ asset('images/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}">
            </div>
        </div>

        <!-- 📄 Información del producto -->
        <div class="product-info">
            <h1 class="product-title">{{ $producto->nombre }} | SEKAITECH</h1>

            <p class="product-description">
                Descubre el <strong>{{ $producto->nombre }}</strong> de <strong>{{ $producto->marca }}</strong>, un producto diseñado para ofrecerte el máximo rendimiento y calidad. 
                {{ $producto->descripcion }}. Compra ahora y aprovecha nuestras ofertas exclusivas!
            </p>

            <div class="product-details">
                <p><strong>Marca:</strong> {{ $producto->marca }}</p>
                <p><strong>Referencia:</strong> </p>
                <p><strong>Estado:</strong> </p>
                <p><strong>En stock:</strong> </p>
            </div>

            <!-- 💰 Contenedor de precios -->
            <div id="product-prices">
                <p id="product-price-red">
                    <strong></strong> $/.{{ number_format($producto->precio_dolares, 2) }}
                </p>
                <p id="product-price-green">
                    <strong></strong> S/.{{ number_format($producto->precio_soles, 2) }}
                </p>
            </div>
            <!-- 🛒 Botones de compra -->
            <div class="product-buttons">
                <a href="https://wa.me/51933573985?text=Hola,%20estoy%20interesado%20en%20el%20producto%20{{ urlencode($producto->nombre) }}%20-%20Precio:%20${{ number_format((float) $producto->precio_dolares, 2) }}"
                    class="btn btn-success" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>
                <button class="btn btn-outline-primary like-button" data-id="{{ $producto->id }}">
                    <i class="fas fa-thumbs-up"></i> <span class="like-count">0</span> Likes
                </button>
            </div>
        </div>
    </div>

    <!-- 🛠 Especificaciones Técnicas -->
    <div class="product-specs">
        <h2>DETALLES</h2>
        <ul class="specs-list">
            @if($producto->marca && $producto->marca !== 'NA')
            <li><strong>Marca:</strong> {{ $producto->marca }}</li>
            @endif
            @if($producto->modelo && $producto->modelo !== 'NA')
            <li><strong>Modelo:</strong> {{ $producto->modelo }}</li>
            @endif
            @if($producto->procesador && $producto->procesador !== 'NA')
            <li><strong>Procesador:</strong> {{ $producto->procesador }}</li>
            @endif
            @if($producto->ram && $producto->ram !== 'NA')
            <li><strong>Memoria RAM:</strong> {{ $producto->ram }}</li>
            @endif
        </ul>

        <!-- 🔹 Información adicional -->
        <div class="specs-info">
            <h3>Importante</h3>
            <ul>
                <li>📷 <strong>IMÁGENES DE REFERENCIA</strong></li>
                <li>💰 <strong>Precio del producto incluye IGV.</strong></li>
                <li>🚚 <strong>Precio no incluye flete y Delivery por envío.</strong></li>
                <li>⚠️ <strong>El precio y stock están sujetos a variación sin previo aviso.</strong></li>
            </ul>
        </div>
    </div>
</div>


@include('partials.product-slider', ['productos' => \App\Models\Producto::inRandomOrder()->take(24)->get()])

<!-- Schema Markup para SEO -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org/",
        "@type": "Product",
        "name": "{{ $producto->nombre }}",
        "description": "{{ $producto->descripcion }}",
        "brand": {
            "@type": "Brand",
            "name": "{{ $producto->marca }}"
        },
        "image": "{{ asset('images/' . $producto->imagen_url) }}",
        "offers": {
            "@type": "Offer",
            "price": "{{ $producto->precio_dolares }}",
            "priceCurrency": "USD",
            "availability": "{{ $producto->stock > 0 ? 'InStock' : 'OutOfStock' }}",
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
    document.addEventListener("DOMContentLoaded", function() {
        const img = document.querySelector(".product-main-image img");
        const modal = document.querySelector(".fullscreen-modal");
        const modalImg = document.querySelector(".fullscreen-modal img");
        const closeBtn = document.querySelector(".fullscreen-modal .close-btn");

    });
</script>
@endsection