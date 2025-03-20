<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

@extends('layouts.app', ['ocultarSlider' => true])

@section('title', 'Productos de Tecnología - Laptops, Tarjetas Gráficas y Monitores | SEKAITECH')

@section('meta-description', 'Encuentra los mejores productos de tecnología en SEKAITECH: laptops, tarjetas gráficas, monitores y más. Calidad garantizada y envíos rápidos en Huánuco.')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex flex-col md:flex-row">
        <!-- Sidebar (Filtros) -->
        <div class="w-full md:w-1/4 p-4">
            <div class="sidebar-container">
                <!-- Formulario de Filtros -->
                <form id="filter-form" method="GET" action="{{ url()->current() }}">
    <!-- Filtro de Precio -->
    <div>
        <h2>FILTER BY PRICE</h2>
        <div class="price-container">
            <span id="price-label">${{ request('max_price', 0) }}</span>
            <span>$5000</span>
        </div>
        <input type="range" id="price" name="max_price" min="0" max="5000" step="1" value="{{ request('max_price', 5000) }}" class="price-range w-full mt-2">
    </div>

    

    <!-- Filtro de Categoría -->
    <div class="mb-6">
        <h2>CATEGORY</h2>
        <select name="categoria_id" class="category-select">
            <option value="">All Categories</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>

    <!-- Botón de Filtrar -->
    <button type="submit" class="filter-button mt-6">FILTRAR</button>
</form>

                <!-- Sección Top de Ventas -->
                <div class="top-sales mt-8">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">TOP DE VENTAS</h2>
                    <ul id="top-sales-list" class="space-y-4">
                        @foreach($topVentas as $producto)
                            <li class="flex items-center space-x-4 border-b pb-3">
                                <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="flex items-center space-x-4">
                                    <img src="{{ asset('images/' . $producto->imagen_url) }}" class="top-sales-img">
                                    <div class="top-sales-info">
                                        <p class="top-sales-name">{{ $producto->nombre }}</p>
                                        <p class="top-sales-price">${{ number_format($producto->precio_dolares, 2) }}</p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Main Content (Productos) -->
        <div class="w-full md:w-3/4 p-4">
            <!-- Selectores de cantidad y vista -->
            <div class="selectors-container mb-4">
                <!-- Selector de cantidad de productos por página -->
                <div class="per-page-selector">
                    <label for="per_page">Productos por página:</label>
                    <select id="per_page" name="per_page" onchange="updatePerPage(this.value)">
                        <option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6</option>
                        <option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9</option>
                        <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>
                        <option value="16" {{ request('per_page') == 16 ? 'selected' : '' }}>16</option>
                    </select>
                </div>

                <!-- Selector de vista -->
                <div class="view-selector">
                    <label for="view_mode">Vista:</label>
                    <select id="view_mode" name="view_mode" onchange="changeViewMode(this.value)">
                        <option value="grid" {{ request('view_mode', 'grid') == 'grid' ? 'selected' : '' }}>Cuadrícula</option>
                        <option value="list" {{ request('view_mode') == 'list' ? 'selected' : '' }}>Lista</option>
                    </select>
                </div>
            </div>

            <!-- Contenedor de productos -->
<div id="product-container" class="product-grid-specific">
    @foreach($productos as $producto)
        <div class="product-card-specific">
            <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="product-image-link">
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

            <!-- Contenedor de paginación -->
            <div id="pagination-container" class="mt-4">
                {!! $productos->appends(request()->query())->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
</div>

<script>
    // Simular tiempo de carga
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.querySelectorAll('.product-card-specific').forEach(card => {
                card.style.opacity = '1';
            });
        }, 500); // 500ms de retraso
    });

    // Actualizar la cantidad de productos por página
    function updatePerPage(value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        window.location.href = url.toString();
    }

    // Cambiar la vista entre cuadrícula y lista
function changeViewMode(mode) {
    const productContainer = document.getElementById('product-container');
    if (mode === 'list') {
        productContainer.classList.remove('product-grid-specific');
        productContainer.classList.add('product-list-specific');
    } else {
        productContainer.classList.remove('product-list-specific');
        productContainer.classList.add('product-grid-specific');
    }

    // Guardar la preferencia de vista en localStorage
    localStorage.setItem('view_mode', mode);
}

// Cargar la vista guardada al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    const savedViewMode = localStorage.getItem('view_mode') || 'grid';
    changeViewMode(savedViewMode);
    document.getElementById('view_mode').value = savedViewMode;
});

    // JavaScript para el filtro de productos
    document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById("filter-form");

    // Detectar envío del formulario y aplicar los filtros
    filterForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Evita recargar la página

        const formData = new FormData(filterForm);
        const queryString = new URLSearchParams(formData).toString();

        // Redirigir a la misma página con los filtros aplicados
        window.location.href = window.location.pathname + '?' + queryString;
    });
});
</script>

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
@endsection