@extends('layouts.app', ['ocultarSlider' => true])

@php
// Generar keywords dinámicas
$keywords = [
strtolower($producto->nombre),
strtolower($producto->marca),
strtolower($producto->modelo),
strtolower($producto->categoria->nombre),
'precio ' . number_format($producto->precio_dolares, 2) . ' dólares',
'precio ' . number_format($producto->precio_soles, 2) . ' soles',
'comprar ' . strtolower($producto->nombre),
strtolower($producto->nombre) . ' en Huánuco',
strtolower($producto->nombre) . ' en Perú',
strtolower($producto->marca) . ' ' . strtolower($producto->nombre),
strtolower($producto->procesador),
strtolower($producto->ram),
strtolower($producto->categoria->nombre) . ' ' . strtolower($producto->marca),
'oferta ' . strtolower($producto->nombre),
'envío rápido ' . strtolower($producto->nombre),
'garantía ' . strtolower($producto->nombre),
'soporte técnico ' . strtolower($producto->nombre),
'tecnología ' . strtolower($producto->categoria->nombre),
'computadoras ' . strtolower($producto->marca),
'laptops ' . strtolower($producto->marca),
'monitores ' . strtolower($producto->marca),
];

// Eliminar duplicados y unir en una cadena
$keywords = implode(', ', array_unique($keywords));
@endphp

@section('title', ucwords($producto->nombre) . ' - ' . ucwords($producto->marca) . ' | Compra Monitores, PCs y Laptops en SEKAITECH')

@section('meta-description', '' . $producto->nombre . ' de ' . $producto->marca .
' al mejor precio en SEKAITECH. Especificaciones: Procesador ' . $producto->procesador . ', ' . $producto->ram .
' de RAM. Ideal para ' . strtolower($producto->categoria->nombre) . '. Envíos rápidos a todo Perú. Precio: $' .
number_format($producto->precio_dolares, 2) . ' | S/' . number_format($producto->precio_soles, 2) .
'. ¡Garantía y soporte técnico incluido! Compra ahora y aprovecha nuestras ofertas exclusivas.')

@section('keywords', $keywords)

@section('og:title', ucwords($producto->nombre) . ' - ' . ucwords($producto->marca) . ' | SEKAITECH')
@section('og:description', 'Compra el ' . $producto->nombre . ' de ' . $producto->marca .
' al mejor precio. Especificaciones: Procesador ' . $producto->procesador . ', ' . $producto->ram .
' de RAM. Envíos rápidos a todo Perú. ¡Garantía y soporte técnico incluido!')
@section('og:image', asset('images/' . $producto->imagen_url))

@section('twitter:title', ucwords($producto->nombre) . ' - ' . ucwords($producto->marca) . ' | SEKAITECH')
@section('twitter:description', 'Compra el ' . $producto->nombre . ' de ' . $producto->marca .
' al mejor precio. Especificaciones: Procesador ' . $producto->procesador . ', ' . $producto->ram .
' de RAM. Envíos rápidos a todo Perú. ¡Garantía y soporte técnico incluido!')
@section('twitter:image', asset('images/' . $producto->imagen_url))

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
            <h1 class="product-title">{{ ucwords($producto->nombre) }} | SEKAITECH</h1>

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
                    <strong></strong> $/ {{ number_format($producto->precio_dolares, 2) }}
                </p>
                <p id="product-price-green">
                    <strong></strong> S/ {{ number_format($producto->precio_soles, 2) }}
                </p>
            </div>
            <!-- 🛒 Botones de compra -->
            <div class="product-buttons">
                <!-- Botón de WhatsApp -->
                <a href="https://wa.me/51933573985?text=Hola,%20estoy%20interesado%20en%20el%20producto%20{{ urlencode($producto->nombre) }}%20-%20Precio:%20${{ number_format((float) $producto->precio_dolares, 2) }}"
                    class="btn btn-success whatsapp-button" target="_blank">
                    <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                </a>

                <!-- Botón de Like -->
                <button class="btn btn-outline-primary like-button" id="likeButton-{{ $producto->id }}" data-id="{{ $producto->id }}">
                    <i class="fas fa-thumbs-up"></i> <span class="like-count">0</span> Likes
                </button>
            </div>
        </div>
    </div>

    <!-- 🛠 Especificaciones Técnicas -->
    <div class="product-specs">
        <!-- 🛠 Pestañas -->
        <ul class="nav nav-tabs" id="specsTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="detalles-tab" data-bs-toggle="tab" data-bs-target="#detalles" type="button" role="tab" aria-controls="detalles" aria-selected="true">
                    Detalles
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="especificaciones-tab" data-bs-toggle="tab" data-bs-target="#especificaciones" type="button" role="tab" aria-controls="especificaciones" aria-selected="false">
                    Especificaciones
                </button>
            </li>
        </ul>

        <!-- 🛠 Contenido de las pestañas -->
        <div class="tab-content" id="specsTabsContent">
            <!-- 🛠 Pestaña de Detalles -->
            <div class="tab-pane fade show active" id="detalles" role="tabpanel" aria-labelledby="detalles-tab">
                <ul class="specs-list mt-3">
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
            </div>

            <!-- 🛠 Pestaña de Especificaciones -->
            <div class="tab-pane fade" id="especificaciones" role="tabpanel" aria-labelledby="especificaciones-tab">
                @if($producto->especificaciones->count() > 0)
                <ul class="specs-list mt-3">
                    @foreach($producto->especificaciones as $especificacion)
                    <li><strong>{{ $especificacion->campo }}:</strong> {{ $especificacion->descripcion }}</li>
                    @endforeach
                </ul>
                @else
                <p class="mt-3">No hay especificaciones adicionales para este producto.</p>
                @endif
            </div>
        </div>

        <!-- 🔹 Información adicional -->
        <div class="specs-info mt-4">
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
<!-- JSON-LD Schema corregido -->
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
        "sku": "{{ $producto->sku ?? 'N/A' }}",
        "category": "{{ $producto->categoria->nombre ?? 'Tecnología' }}",
        "keywords": "{{ $keywords }}",
        "image": "{{ asset('images/' . $producto->imagen_url) }}",
        "offers": {
            "@type": "Offer",
            "price": "{{ $producto->precio_dolares }}",
            "priceCurrency": "USD",
            "availability": "{{ $producto->stock > 0 ? 'InStock' : 'OutOfStock' }}",
            "priceValidUntil": "{{ now()->addMonths(6)->toDateString() }}",
            "seller": {
                "@type": "Organization",
                "name": "SEKAITECH"
            }
        },
        "shippingDetails": {
            "@type": "OfferShippingDetails",
            "shippingRate": {
                "@type": "MonetaryAmount",
                "value": "20.00",
                "currency": "USD"
            },
            "shippingDestination": {
                "@type": "DefinedRegion",
                "addressCountry": "PE"
            },
            "deliveryTime": {
                "@type": "ShippingDeliveryTime",
                "businessDays": {
                    "@type": "OpeningHoursSpecification",
                    "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
                    "opens": "08:00",
                    "closes": "20:00"
                },
                "handlingTime": "P1D",
                "transitTime": "P3D"
            }
        },
        "hasMerchantReturnPolicy": {
            "@type": "MerchantReturnPolicy",
            "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
            "merchantReturnDays": 28,
            "returnMethod": "ReturnByMail",
            "returnFees": "FreeReturn"
        },
        "review": {
            "@type": "Review",
            "reviewRating": {
                "@type": "Rating",
                "ratingValue": "5",
                "bestRating": "5"
            },
            "author": {
                "@type": "Person",
                "name": "Johann"
            }
        },
        "aggregateRating": {
            "@type": "AggregateRating",
            "ratingValue": "4.8",
            "reviewCount": "125"
        }
    }
</script>
<style>
    /* Estilos generales para los botones */
    .product-buttons {
        display: flex;
        gap: 10px;
        /* Espacio entre los botones */
        margin-top: 15px;
    }

    /* Estilos para el botón de WhatsApp */
    .whatsapp-button {
        background-color: #25D366;
        /* Color de WhatsApp */
        border: none;
        color: white;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: background-color 0.3s ease, transform 0.2s ease;
    }

    .whatsapp-button:hover {
        background-color: #128C7E;
        /* Color más oscuro al hacer hover */
        transform: translateY(-2px);
        /* Efecto de levantamiento */
    }

    .whatsapp-button:active {
        transform: translateY(0);
        /* Restablece la posición al hacer clic */
    }

    /* Estilos para el botón de Like */
</style>

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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Selecciona todos los botones de Like
        const likeButtons = document.querySelectorAll('.like-button');

        likeButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Alternar la clase 'liked' para cambiar el estilo
                this.classList.toggle('liked');

                // Simular un incremento en el contador de likes (puedes ajustar esto según tu lógica)
                const likeCount = this.querySelector('.like-count');
                let count = parseInt(likeCount.textContent);
                likeCount.textContent = this.classList.contains('liked') ? count + 1 : count - 1;
            });
        });
    });
</script>
@endsection