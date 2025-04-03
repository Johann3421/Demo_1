@extends('layouts.app', ['ocultarSlider' => true])

@php
    $seoTemplates = [
        'Laptops' => [
            'title' => '{nombre} {marca} | Potencia y Movilidad - SEKAITECH',
            'description' =>
                'Laptop {nombre} {marca} con {procesador} y {ram} RAM. Ideal para {uso}. ¡Compra ahora con garantía!',
            'keywords' =>
                '{nombre}, {marca}, laptop {modelo}, laptop {procesador}, laptop {ram}, laptop {uso}, comprar laptop',
        ],
        'Componentes para pc' => [
            'title' => '{nombre} {marca} | Mejora tu PC - SEKAITECH',
            'description' =>
                '{nombre} {marca}: {descripcion}. ¡Optimiza tu rendimiento con nuestros componentes de PC!',
            'keywords' =>
                '{nombre}, {marca}, componente pc {modelo}, {tipo_componente}, mejorar pc, comprar componentes pc',
        ],
        'Monitores' => [
            'title' => '{nombre} {marca} | Alta Resolución - SEKAITECH',
            'description' =>
                'Monitor {nombre} {marca} con {resolucion} y {tasa_refresco}. ¡Imágenes nítidas para trabajar y jugar!',
            'keywords' =>
                '{nombre}, {marca}, monitor {modelo}, monitor {resolucion}, monitor {tasa_refresco}, comprar monitor',
        ],
        'Impresoras' => [
            'title' => '{nombre} {marca} | Impresión Eficiente - SEKAITECH',
            'description' => 'Impresora {nombre} {marca}: {descripcion}. ¡Imprime con calidad y rapidez!',
            'keywords' => '{nombre}, {marca}, impresora {modelo}, impresora {tipo_impresora}, comprar impresora',
        ],
        'Computadoras' => [
            'title' => '{nombre} {marca} | Potencia y Rendimiento - SEKAITECH',
            'description' =>
                'Computadora {nombre} {marca} con {procesador} y {ram} RAM. Ideal para {uso}. ¡Compra ahora con garantía!',
            'keywords' =>
                '{nombre}, {marca}, computadora {modelo}, computadora {procesador}, computadora {ram}, computadora {uso}, comprar computadora',
        ],
    ];

    // Obtener la plantilla de SEO para la categoría del producto
    $categoriaNombre = $producto->categoria->nombre;
    $seo = $seoTemplates[$categoriaNombre] ?? $seoTemplates['Laptops']; // Usar 'Laptops' como fallback

    // Reemplazar los marcadores de posición con los datos del producto
    $title = str_replace(
        [
            '{nombre}',
            '{marca}',
            '{modelo}',
            '{procesador}',
            '{ram}',
            '{uso}',
            '{resolucion}',
            '{tasa_refresco}',
            '{descripcion}',
            '{tipo_componente}',
            '{tipo_impresora}',
        ],
        [
            ucwords($producto->nombre),
            ucwords($producto->marca),
            $producto->modelo,
            $producto->procesador,
            $producto->ram,
            $producto->uso,
            $producto->resolucion,
            $producto->tasa_refresco,
            $producto->descripcion,
            $producto->tipo_componente,
            $producto->tipo_impresora,
        ],
        $seo['title'],
    );

    $description = str_replace(
        [
            '{nombre}',
            '{marca}',
            '{modelo}',
            '{procesador}',
            '{ram}',
            '{uso}',
            '{resolucion}',
            '{tasa_refresco}',
            '{descripcion}',
            '{tipo_componente}',
            '{tipo_impresora}',
        ],
        [
            $producto->nombre,
            $producto->marca,
            $producto->modelo,
            $producto->procesador,
            $producto->ram,
            $producto->uso,
            $producto->resolucion,
            $producto->tasa_refresco,
            $producto->descripcion,
            $producto->tipo_componente,
            $producto->tipo_impresora,
        ],
        $seo['description'],
    );

    $keywords = str_replace(
        [
            '{nombre}',
            '{marca}',
            '{modelo}',
            '{procesador}',
            '{ram}',
            '{uso}',
            '{resolucion}',
            '{tasa_refresco}',
            '{descripcion}',
            '{tipo_componente}',
            '{tipo_impresora}',
        ],
        [
            $producto->nombre,
            $producto->marca,
            $producto->modelo,
            $producto->procesador,
            $producto->ram,
            $producto->uso,
            $producto->resolucion,
            $producto->tasa_refresco,
            $producto->descripcion,
            $producto->tipo_componente,
            $producto->tipo_impresora,
        ],
        $seo['keywords'],
    );

    // Generar URL del producto
    $productUrl = url()->current();
@endphp

@section('title', $title . ' | Compra Monitores, PCs y Laptops en SEKAITECH')

@section('meta-description',
    $description .
    ' Precio: $' .
    number_format($producto->precio_dolares, 2) .
    ' | S/' .
    number_format($producto->precio_soles, 2) .
    '. ¡Garantía y soporte técnico incluido! Compra ahora y aprovecha nuestras
    ofertas exclusivas.')

@section('keywords', $keywords . ', precio ' . number_format($producto->precio_dolares, 2) . ' dólares, precio ' .
    number_format($producto->precio_soles, 2) . ' soles, comprar ' . strtolower($producto->nombre))

@section('og:title', $title . ' | SEKAITECH')
@section('og:description', $description . ' Envíos rápidos a todo Perú. ¡Garantía y soporte técnico incluido!')
@section('og:image', asset('images/' . $producto->imagen_url))
@section('og:url', $productUrl)

@section('twitter:title', $title . ' | SEKAITECH')
@section('twitter:description', $description . ' Envíos rápidos a todo Perú. ¡Garantía y soporte técnico incluido!')
@section('twitter:image', asset('images/' . $producto->imagen_url))

@section('content')
    <div class="container product-page">
        <div class="product-container">
            <!-- 📷 Imagen del producto -->
            <div class="product-gallery">
                <!-- Imagen principal -->
                <div class="product-main-image">
                    <img src="{{ asset('images/' . $producto->imagen_url) }}" alt="{{ $producto->nombre }}"
                        class="img-fluid main-img">
                </div>

                <!-- Miniaturas (4 veces la misma imagen) -->
                <div class="product-thumbnails">
                    @for ($i = 0; $i < 4; $i++)
                        <img src="{{ asset('images/' . $producto->imagen_url) }}"
                            alt="{{ $producto->nombre }} - Vista {{ $i + 1 }}" class="thumbnail">
                    @endfor
                </div>

                <!-- Modal para pantalla completa -->
                <div class="image-modal">
                    <span class="close-modal">&times;</span>
                    <img class="modal-content">
                </div>
            </div>

            <!-- 📄 Información del producto -->
            <div class="product-info">
                <h1 class="product-title">{{ ucwords($producto->nombre) }} | SEKAITECH</h1>
                <div class="product-details">
                    <div class="detail-row">
                        <strong>Marca:</strong>
                        <span>{{ $producto->marca }}</span>
                    </div>
                    <div class="detail-row">
                        <strong>Código Interno:</strong>
                        <span>{{ $producto->sku ?? 'N/A' }}</span>
                    </div>
                    <div class="detail-row">
                        <strong>Estado:</strong>
                        <span>{{ $producto->estado ?? 'Disponible' }}</span>
                    </div>
                    <div class="detail-row">
                        <strong>En stock:</strong>
                        <span>{{ $producto->stock }}</span>
                    </div>
                </div>

                <div class="purchase-details">
                    <ul class="purchase-features">
                        <li class="purchase-feature">
                            <svg class="feature-icon" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12,2L4,5V11.09C4,16.14 7.41,20.85 12,22C16.59,20.85 20,16.14 20,11.09V5L12,2M12,7C13.66,7 15,8.34 15,10C15,11.66 13.66,13 12,13C10.34,13 9,11.66 9,10C9,8.34 10.34,7 12,7M12,15.5C14.33,15.5 18,16.56 18,17.5V18.5H6V17.5C6,16.56 9.67,15.5 12,15.5Z" />
                            </svg>
                            <span class="feature-text">Compra Segura <strong class="highlight">¡¡Con Garantía!!</strong></span>
                        </li>
                        <li class="purchase-feature">
                            <svg class="feature-icon" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12,1L3,5V11C3,16.55 6.84,21.74 12,23C17.16,21.74 21,16.55 21,11V5L12,1M12,7C13.4,7 14.8,8.1 14.8,9.5V11C15.4,11 16,11.6 16,12.2V15.7C16,16.4 15.4,17 14.7,17H9.2C8.6,17 8,16.4 8,15.8V12.2C8,11.6 8.6,11 9.2,11V9.5C9.2,8.1 10.6,7 12,7M12,8.2C11.2,8.2 10.5,8.7 10.5,9.5V11H13.5V9.5C13.5,8.7 12.8,8.2 12,8.2Z" />
                            </svg>
                            <span class="feature-text">Precio incluye el <strong class="highlight">I.G.V</strong></span>
                        </li>
                        <li class="purchase-feature">
                            <svg class="feature-icon" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M12,2C6.48,2 2,6.48 2,12C2,17.52 6.48,22 12,22C17.52,22 22,17.52 22,12C22,6.48 17.52,2 12,2M12,20C7.59,20 4,16.41 4,12C4,7.59 7.59,4 12,4C16.41,4 20,7.59 20,12C20,16.41 16.41,20 12,20M13,17H11V15H13V17M13,13H11V7H13V13Z" />
                            </svg>
                            <span class="feature-text">Precio sujeto a cambios sin previo aviso</span>
                        </li>
                        <li class="purchase-feature">
                            <svg class="feature-icon" viewBox="0 0 24 24">
                                <path fill="currentColor"
                                    d="M19,15H18A3,3 0 0,1 15,18V19A3,3 0 0,1 12,22A3,3 0 0,1 9,19V18A3,3 0 0,1 6,15H5A3,3 0 0,1 2,12A3,3 0 0,1 5,9H6A3,3 0 0,1 9,6V5A3,3 0 0,1 12,2A3,3 0 0,1 15,5V6A3,3 0 0,1 18,9H19A3,3 0 0,1 22,12A3,3 0 0,1 19,15M12,4A1,1 0 0,0 11,5V6A1,1 0 0,0 12,7A1,1 0 0,0 13,6V5A1,1 0 0,0 12,4M12,20A1,1 0 0,0 13,19V18A1,1 0 0,0 12,17A1,1 0 0,0 11,18V19A1,1 0 0,0 12,20M5,11A1,1 0 0,0 6,12A1,1 0 0,0 5,13A1,1 0 0,0 4,12A1,1 0 0,0 5,11M19,11A1,1 0 0,0 20,12A1,1 0 0,0 19,13A1,1 0 0,0 18,12A1,1 0 0,0 19,11Z" />
                            </svg>
                            <span class="feature-text">Precio no incluye flete por envío</span>
                        </li>
                    </ul>
                </div>



                <div class="product-prices-container">
                    <div class="price-card dollar">
                        <div class="price-flag">USD</div>
                        <div class="price-content">
                            <span class="price-currency">$</span>
                            <span class="price-value">{{ number_format($producto->precio_dolares, 2) }}</span>
                        </div>
                        <div class="price-label">Precio en Dólares</div>
                    </div>

                    <div class="price-card sol">
                        <div class="price-flag">PEN</div>
                        <div class="price-content">
                            <span class="price-currency">S/</span>
                            <span class="price-value">{{ number_format($producto->precio_soles, 2) }}</span>
                        </div>
                        <div class="price-label">Precio en Soles</div>
                    </div>
                </div>

                <!-- 🛒 Botones de compra -->
                <div class="product-buttons">
                    <a href="https://wa.me/51933573985?text=Hola,%20estoy%20interesado%20en%20el%20producto:%20{{ urlencode($producto->nombre) }}%0A%0APrecio:%20${{ number_format($producto->precio_dolares, 2) }}%20|%20S/{{ number_format($producto->precio_soles, 2) }}%0A%0AVer%20producto:%20{{ urlencode($productUrl) }}"
                        class="btn btn-success whatsapp-button" target="_blank">
                        <i class="fab fa-whatsapp"></i> Contactar por WhatsApp
                    </a>

                    <button class="btn btn-outline-primary like-button" id="likeButton-{{ $producto->id }}"
                        data-id="{{ $producto->id }}">
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
                    <button class="nav-link active" id="detalles-tab" data-bs-toggle="tab" data-bs-target="#detalles"
                        type="button" role="tab" aria-controls="detalles" aria-selected="true">
                        Detalles
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="especificaciones-tab" data-bs-toggle="tab"
                        data-bs-target="#especificaciones" type="button" role="tab" aria-controls="especificaciones"
                        aria-selected="false">
                        Especificaciones
                    </button>
                </li>
            </ul>

            <!-- 🛠 Contenido de las pestañas -->
            <div class="tab-content p-3 bg-white" id="specsTabsContent">
                <!-- 🛠 Pestaña de Detalles -->
                <div class="tab-pane fade show active" id="detalles" role="tabpanel" aria-labelledby="detalles-tab">
                    <div class="specs-grid bg-white">
                        @if ($producto->marca && $producto->marca !== 'NA')
                            <div class="spec-row">
                                <div class="spec-field">Marca:</div>
                                <div class="spec-value">{{ $producto->marca }}</div>
                            </div>
                        @endif
                        @if ($producto->modelo && $producto->modelo !== 'NA')
                            <div class="spec-row">
                                <div class="spec-field">Modelo:</div>
                                <div class="spec-value">{{ $producto->modelo }}</div>
                            </div>
                        @endif
                        @if ($producto->procesador && $producto->procesador !== 'NA')
                            <div class="spec-row">
                                <div class="spec-field">Procesador:</div>
                                <div class="spec-value">{{ $producto->procesador }}</div>
                            </div>
                        @endif
                        @if ($producto->ram && $producto->ram !== 'NA')
                            <div class="spec-row">
                                <div class="spec-field">Memoria RAM:</div>
                                <div class="spec-value">{{ $producto->ram }}</div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 🛠 Pestaña de Especificaciones -->
                <div class="tab-pane fade" id="especificaciones" role="tabpanel" aria-labelledby="especificaciones-tab">
                    @if ($producto->especificaciones->count() > 0)
                        <div class="specs-grid bg-white p-3">
                            @foreach ($producto->especificaciones as $especificacion)
                                <div class="spec-row">
                                    <div class="spec-field">{{ $especificacion->campo }}:</div>
                                    <div class="spec-value">{{ $especificacion->descripcion }}</div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mt-3 bg-white p-3">No hay especificaciones adicionales para este producto.</p>
                    @endif
                </div>
            </div>

            <!-- 🔹 Información adicional -->
            <div class="additional-info mt-4 p-3 bg-white">
                <h3 class="mb-3">Importante</h3>
                <ul class="info-list">
                    <li><i class="fas fa-camera me-2"></i> <strong>IMÁGENES DE REFERENCIA</strong></li>
                    <li><i class="fas fa-money-bill-wave me-2"></i> <strong>Precio del producto incluye IGV.</strong></li>
                    <li><i class="fas fa-truck me-2"></i> <strong>Precio no incluye flete y Delivery por envío.</strong>
                    </li>
                    <li><i class="fas fa-exclamation-triangle me-2"></i> <strong>El precio y stock están sujetos a
                            variación sin previo aviso.</strong></li>
                </ul>
            </div>
        </div>
    </div>

    @include('partials.product-slider', [
    'productos' => \App\Models\Producto::where('categoria_id', $producto->categoria_id)
        ->where('id', '!=', $producto->id) // Excluir el producto actual
        ->inRandomOrder()
        ->take(24)
        ->get(),
])


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
        document.querySelectorAll('.detail-row span').forEach(span => {
            span.addEventListener('mouseover', function() {
                this.setAttribute('title', this.textContent);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const mainImg = document.querySelector('.main-img');
            const thumbnails = document.querySelectorAll('.thumbnail');
            const modal = document.querySelector('.image-modal');
            const modalImg = document.querySelector('.modal-content');
            const closeModal = document.querySelector('.close-modal');

            // 1. Modal pantalla completa
            mainImg.addEventListener('click', () => {
                modal.style.display = 'flex';
                modalImg.src = mainImg.src;
            });

            closeModal.addEventListener('click', () => {
                modal.style.display = 'none';
            });

            modal.addEventListener('click', (e) => {
                if (e.target === modal) modal.style.display = 'none';
            });

            // 2. Zoom con lupa (fluido)
            const lens = document.createElement('div');
            lens.className = 'zoom-lens';
            document.body.appendChild(lens); // Se añade al body para evitar overflow

            mainImg.addEventListener('mousemove', (e) => {
                const imgRect = mainImg.getBoundingClientRect();
                const scale = 2; // Nivel de zoom

                // Posición del mouse relativa a la imagen
                let x = e.clientX - imgRect.left;
                let y = e.clientY - imgRect.top;

                // Ajustar para que la lupa no salga de la imagen
                x = Math.max(75, Math.min(x, imgRect.width - 75));
                y = Math.max(75, Math.min(y, imgRect.height - 75));

                // Mover la lupa
                lens.style.left = `${e.clientX}px`;
                lens.style.top = `${e.clientY}px`;
                lens.style.opacity = '1';

                // Efecto de zoom (simulado)
                lens.style.backgroundImage = `url(${mainImg.src})`;
                lens.style.backgroundSize = `${imgRect.width * scale}px ${imgRect.height * scale}px`;
                lens.style.backgroundPosition = `-${(x - 75) * scale}px -${(y - 75) * scale}px`;
            });

            mainImg.addEventListener('mouseleave', () => {
                lens.style.opacity = '0';
            });

            // 3. Miniaturas (cambiar imagen principal)
            thumbnails.forEach(thumb => {
                thumb.addEventListener('click', () => {
                    mainImg.src = thumb.src;
                });
            });
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
                    likeCount.textContent = this.classList.contains('liked') ? count + 1 : count -
                        1;
                });
            });
        });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Seleccionar todos los botones de like
        const likeButtons = document.querySelectorAll('.like-button');

        likeButtons.forEach(button => {
            const productId = button.dataset.id;
            const likeCountSpan = button.querySelector('.like-count');

            // Clave única para almacenar en localStorage
            const storageKey = `product_like_${productId}`;

            // Obtener likes guardados o inicializar a 0
            let likes = parseInt(localStorage.getItem(storageKey)) || 0;
            likeCountSpan.textContent = likes;

            // Verificar si el usuario ya dio like (para cambiar el estilo)
            const userLikeKey = `user_like_${productId}`;
            const userLiked = localStorage.getItem(userLikeKey) === 'true';

            if (userLiked) {
                button.classList.add('liked');
                button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
            }

            // Evento click
            button.addEventListener('click', function() {
                const alreadyLiked = localStorage.getItem(userLikeKey) === 'true';

                if (alreadyLiked) {
                    // Quitar like
                    likes = Math.max(0, likes - 1);
                    localStorage.setItem(userLikeKey, 'false');
                    button.classList.remove('liked');
                    button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
                } else {
                    // Añadir like
                    likes += 1;
                    localStorage.setItem(userLikeKey, 'true');
                    button.classList.add('liked');
                    button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
                }

                // Actualizar contador y almacenamiento
                likeCountSpan.textContent = likes;
                localStorage.setItem(storageKey, likes.toString());

                // Efecto visual
                button.classList.add('animate-like');
                setTimeout(() => {
                    button.classList.remove('animate-like');
                }, 300);
            });
        });
    });
    </script>
@endsection
