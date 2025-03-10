@extends('layouts.app')

@section('title', 'Productos de Tecnología - Laptops, Tarjetas Gráficas y Monitores | SEKAITECH')

@section('meta-description', 'Encuentra los mejores productos de tecnología en SEKAITECH: laptops, tarjetas gráficas, monitores y más. Calidad garantizada y envíos rápidos en Huánuco.')

@section('content')
<h1 class="mb-4">Nuestros Productos de Tecnología</h1>
<div class="product-grid-specific">
    <!-- Laptop Lenovo IdeaPad Gaming 3 15IMH05 -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 1, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15imh05']) }}">
            <img src="{{ asset('images/lenovo1.png') }}" class="product-image-specific" alt="Laptop Lenovo IdeaPad Gaming 3 15IMH05 - Intel Core i5, 8GB RAM, 512GB SSD, GTX 1650" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Laptop Lenovo IdeaPad Gaming 3 15IMH05</h2>
            <p class="product-text-specific">Laptop Lenovo IdeaPad Gaming 3 con Intel Core i5-10300H, pantalla 15.6" FHD, 8GB RAM, 512GB SSD y NVIDIA GeForce GTX 1650 4GB. Perfecta para gaming y multitarea.</p>
            <div class="product-price-specific">
                <span class="price-usd">$531.23</span>
                <span class="price-pen">S/. 1976.18</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 1, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15imh05']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>

    <!-- Laptop Lenovo IdeaPad Gaming 3 15ARH05 -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 2, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15arh05']) }}">
            <img src="{{ asset('images/lenovo2.png') }}" class="product-image-specific" alt="Laptop Lenovo IdeaPad Gaming 3 15ARH05 - AMD Ryzen 7, 16GB RAM, 1TB HDD, 256GB SSD, GTX 1650 Ti" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Laptop Lenovo IdeaPad Gaming 3 15ARH05</h2>
            <p class="product-text-specific">Laptop Lenovo IdeaPad Gaming 3 con AMD Ryzen 7 4800H, pantalla 15.6" FHD, 16GB RAM, 1TB HDD + 256GB SSD y NVIDIA GTX 1650 Ti 4GB. Potencia y almacenamiento para gaming.</p>
            <div class="product-price-specific">
                <span class="price-usd">$1031.78</span>
                <span class="price-pen">S/. 3838.22</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 2, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15arh05']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>

    <!-- Tarjeta de Video Gigabyte GTX 1660 Super -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 3, 'slug' => 'tarjeta-video-gigabyte-gtx-1660-super']) }}">
            <img src="{{ asset('images/gtx1.png') }}" class="product-image-specific" alt="Tarjeta de Video Gigabyte GTX 1660 Super - 6GB GDDR6" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Tarjeta de Video Gigabyte GTX 1660 Super</h2>
            <p class="product-text-specific">Tarjeta de video Gigabyte GTX 1660 Super con 6GB GDDR6. Rendimiento excepcional para gaming en 1080p.</p>
            <div class="product-price-specific">
                <span class="price-usd">$470.78</span>
                <span class="price-pen">S/. 1751.30</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 3, 'slug' => 'tarjeta-video-gigabyte-gtx-1660-super']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>

    <!-- Tarjeta de Video Gigabyte AORUS RTX 3070 Master -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 4, 'slug' => 'tarjeta-video-gigabyte-aorus-rtx-3070-master']) }}">
            <img src="{{ asset('images/gtx2.png') }}" class="product-image-specific" alt="Tarjeta de Video Gigabyte AORUS RTX 3070 Master - 8GB GDDR6" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Tarjeta de Video Gigabyte AORUS RTX 3070 Master</h2>
            <p class="product-text-specific">Tarjeta de video Gigabyte AORUS RTX 3070 Master con 8GB GDDR6. Tecnología de trazado de rayos en tiempo real para gaming en 4K.</p>
            <div class="product-price-specific">
                <span class="price-usd">$1105.00</span>
                <span class="price-pen">S/. 4110.60</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 4, 'slug' => 'tarjeta-video-gigabyte-aorus-rtx-3070-master']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>

    <!-- Monitor AOC 24" G2460PQU -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 5, 'slug' => 'monitor-aoc-24-g2460pqu']) }}">
            <img src="{{ asset('images/monitor1.png') }}" class="product-image-specific" alt="Monitor AOC 24 G2460PQU - 24 pulgadas, 144Hz, 1ms" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Monitor AOC 24" G2460PQU</h2>
            <p class="product-text-specific">Monitor AOC 24" G2460PQU con resolución Full HD 1080p, 144Hz y 1ms. Ideal para gaming y diseño con colores precisos y tiempo de respuesta rápido.</p>
            <div class="product-price-specific">
                <span class="price-usd">$186.40</span>
                <span class="price-pen">S/. 693.41</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 5, 'slug' => 'monitor-aoc-24-g2460pqu']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>

    <!-- Monitor Gigabyte G27FC -->
    <div class="product-card-specific">
        <a href="{{ route('producto.detalles', ['id' => 6, 'slug' => 'monitor-gigabyte-g27fc']) }}">
            <img src="{{ asset('images/monitor2.png') }}" class="product-image-specific" alt="Monitor Gigabyte G27FC - 27 pulgadas, 165Hz, curvatura 1500R" loading="lazy">
        </a>
        <div class="product-body-specific">
            <h2 class="product-title-specific">Monitor Gigabyte G27FC</h2>
            <p class="product-text-specific">Monitor Gigabyte G27FC de 27" con resolución Full HD 1080p, 165Hz, 1ms y curvatura 1500R. Experiencia envolvente para gaming y multimedia.</p>
            <div class="product-price-specific">
                <span class="price-usd">$226.66</span>
                <span class="price-pen">S/. 843.18</span>
            </div>
            <a href="{{ route('producto.detalles', ['id' => 6, 'slug' => 'monitor-gigabyte-g27fc']) }}" class="btn btn-primary">Ver Detalles</a>
        </div>
    </div>
</div>

<!-- Schema Markup para SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    {
      "@type": "Product",
      "name": "Laptop Lenovo IdeaPad Gaming 3 15IMH05",
      "description": "Laptop Lenovo IdeaPad Gaming 3 con Intel Core i5-10300H, pantalla 15.6 FHD, 8GB RAM, 512GB SSD y NVIDIA GeForce GTX 1650 4GB.",
      "brand": "Lenovo",
      "image": "{{ asset('images/lenovo1.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "531.23",
        "priceCurrency": "USD"
      }
    },
    {
      "@type": "Product",
      "name": "Laptop Lenovo IdeaPad Gaming 3 15ARH05",
      "description": "Laptop Lenovo IdeaPad Gaming 3 con AMD Ryzen 7 4800H, pantalla 15.6 FHD, 16GB RAM, 1TB HDD + 256GB SSD y NVIDIA GTX 1650 Ti 4GB.",
      "brand": "Lenovo",
      "image": "{{ asset('images/lenovo2.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "1031.78",
        "priceCurrency": "USD"
      }
    },
    {
      "@type": "Product",
      "name": "Tarjeta de Video Gigabyte GTX 1660 Super",
      "description": "Tarjeta de video Gigabyte GTX 1660 Super con 6GB GDDR6.",
      "brand": "Gigabyte",
      "image": "{{ asset('images/gtx1.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "470.78",
        "priceCurrency": "USD"
      }
    },
    {
      "@type": "Product",
      "name": "Tarjeta de Video Gigabyte AORUS RTX 3070 Master",
      "description": "Tarjeta de video Gigabyte AORUS RTX 3070 Master con 8GB GDDR6.",
      "brand": "Gigabyte",
      "image": "{{ asset('images/gtx2.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "1105.00",
        "priceCurrency": "USD"
      }
    },
    {
      "@type": "Product",
      "name": "Monitor AOC 24 G2460PQU",
      "description": "Monitor AOC 24 G2460PQU con resolución Full HD 1080p, 144Hz y 1ms.",
      "brand": "AOC",
      "image": "{{ asset('images/monitor1.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "186.40",
        "priceCurrency": "USD"
      }
    },
    {
      "@type": "Product",
      "name": "Monitor Gigabyte G27FC",
      "description": "Monitor Gigabyte G27FC de 27 con resolución Full HD 1080p, 165Hz, 1ms y curvatura 1500R.",
      "brand": "Gigabyte",
      "image": "{{ asset('images/monitor2.png') }}",
      "offers": {
        "@type": "Offer",
        "price": "226.66",
        "priceCurrency": "USD"
      }
    }
  ]
}
</script>

<script>
    // Simular tiempo de carga
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.querySelectorAll('.product-card-specific').forEach(card => {
                card.style.opacity = '1';
            });
        }, 500); // 500ms de retraso
    });
</script>
@endsection