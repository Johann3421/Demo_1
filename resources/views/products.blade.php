@extends('layouts.app')

@section('title', 'Productos de Tecnología - Laptops, Tarjetas Gráficas y Monitores | SEKAITECH')

@section('meta-description', 'Encuentra los mejores productos de tecnología en SEKAITECH: laptops, tarjetas gráficas, monitores y más. Calidad garantizada y envíos rápidos en Huánuco.')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row">
    @include('components.sidebar')
        <!-- Main Content -->
        <div class="w-full md:w-3/4 p-4">
        @include('components.filter-view')
            <div class="product-grid-specific grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($productos as $producto)
                <div class="product-card-specific text-center">
                    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}">
                        <img src="{{ asset('images/' . $producto->imagen_url) }}" class="product-image-specific" alt="{{ $producto->nombre }}" loading="lazy">
                    </a>
                    <div class="product-body-specific">
                        <h2 class="product-title-specific">{{ $producto->nombre }}</h2>
                        <p class="product-text-specific">{{ $producto->descripcion }}</p>
                        <div class="product-price-specific">
                            <span class="price-usd">${{ number_format($producto->precio_dolares, 2) }}</span>
                            <span class="price-pen">S/. {{ number_format($producto->precio_soles, 2) }}</span>
                        </div>
                        <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="btn btn-primary">Ver Detalles</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Schema Markup para SEO -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "itemListElement": [
    @foreach($productos as $index => $producto)
    {
      "@type": "Product",
      "name": "{{ $producto->nombre }}",
      "description": "{{ $producto->descripcion }}",
      "brand": "{{ $producto->marca }}",
      "image": "{{ asset('images/' . $producto->imagen_url) }}",
      "offers": {
        "@type": "Offer",
        "price": "{{ number_format($producto->precio_dolares, 2) }}",
        "priceCurrency": "USD"
      }
    }{{ $index < count($productos) - 1 ? ',' : '' }}
    @endforeach
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