@extends('layouts.app')

@section('title', 'Productos de Tecnología - Laptops, Tarjetas Gráficas y Monitores | SEKAITECH')

@section('meta-description', 'Encuentra los mejores productos de tecnología en SEKAITECH: laptops, tarjetas gráficas, monitores y más. Calidad garantizada y envíos rápidos en Huánuco.')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar -->
        <div class="w-full md:w-1/4 p-4">
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-2">FILTER BY PRICE</h2>
                <div class="flex items-center justify-between">
                    <span>$2.65</span>
                    <span>$5,302.00</span>
                </div>
                <input class="w-full mt-2" type="range" min="2.65" max="5302"/>
                <button class="mt-2 bg-orange-500 text-white py-2 px-4 rounded">FILTRAR</button>
            </div>
            <div class="mb-8">
                <h2 class="text-lg font-bold mb-2">STOCK STATUS</h2>
                <div>
                    <input type="checkbox" id="on-sale"/>
                    <label for="on-sale">On sale</label>
                </div>
                <div>
                    <input type="checkbox" id="in-stock"/>
                    <label for="in-stock">In stock</label>
                </div>
            </div>
            <div>
                <h2 class="text-lg font-bold mb-2">TOP RATED PRODUCTS</h2>
                <ul>
                    <li class="mb-4">
                        <img src="https://placehold.co/50x50" alt="Soporte a pared del Proyector Láser Interactivo BrightLink EB-735Fi" class="inline-block mr-2"/>
                        <span>Soporte a pared del Proyector Láser Interactivo BrightLink EB-735Fi.</span>
                        <span class="block text-orange-500">$127.25</span>
                    </li>
                    <li class="mb-4">
                        <img src="https://placehold.co/50x50" alt="Impresora HP LaserJet Pro 4003DW" class="inline-block mr-2"/>
                        <span>Impresora HP LaserJet Pro 4003DW</span>
                        <span class="block text-orange-500">$343.24</span>
                    </li>
                    <li class="mb-4">
                        <img src="https://placehold.co/50x50" alt="Mouse Wireless ergonómico vertical JSY-7DW NEGRO pilas" class="inline-block mr-2"/>
                        <span>Mouse Wireless ergonómico vertical JSY-7DW NEGRO pilas</span>
                        <span class="block text-orange-500">$7.95</span>
                    </li>
                </ul>
            </div>
        </div>
        <!-- Main Content -->
        <div class="w-full md:w-3/4 p-4">
            <div class="flex justify-between items-center mb-4">
                <div>
                    <a href="#" class="text-gray-500">Inicio</a> /
                    <a href="#" class="text-gray-500">Tienda</a> /
                    <span class="text-gray-800">LAPTOPS</span>
                </div>
                <div>
                    <span>Show :</span>
                    <a href="#" class="text-gray-500 ml-2">9</a>
                    <a href="#" class="text-gray-500 ml-2">12</a>
                    <a href="#" class="text-gray-500 ml-2">18</a>
                    <a href="#" class="text-gray-500 ml-2">24</a>
                    <i class="fas fa-th-large ml-4"></i>
                    <i class="fas fa-th-list ml-2"></i>
                    <a href="#" class="text-gray-500 ml-2">Filters</a>
                </div>
            </div>
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