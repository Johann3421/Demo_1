<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/productos.css') }}">

@extends('layouts.app', ['ocultarSlider' => true])

@section('title', 'Productos de Tecnología - Laptops, Tarjetas Gráficas y Monitores | SEKAITECH')

@section('meta-description',
    'Encuentra los mejores productos de tecnología en SEKAITECH: laptops, tarjetas gráficas,
    monitores y más. Calidad garantizada y envíos rápidos en Huánuco.')

@section('content')
    <!-- Contenedor Principal -->
    <!-- Botón para abrir el sidebar en móviles -->
    <button class="sidebar-toggle md:hidden" onclick="toggleSidebar()">☰ Filtros</button>
    <div class="main-wrapper mx-auto p-4">
        <div class="flex flex-col md:flex-row">
            <!-- Sidebar (Filtros) -->
            <div class="w-full md:w-1/4">
                <div class="filters-wrapper">
                    <!-- Formulario de Filtros -->
                    <form id="filter-form" method="GET">
                        <!-- Filtro de Precio -->
                        <div>
                            <h2>FILTRO POR PRECIO</h2>
                            <div class="price-container">
                                <span id="price-label">${{ request('max_price', 0) }}</span>
                                <span>$5000</span>
                            </div>
                            <input type="range" id="price" name="max_price" min="0" max="5000"
                                step="1" value="{{ request('max_price', 5000) }}" class="price-range w-full mt-2">
                        </div>

                        <!-- Filtro de Categoría -->
                        <div class="mb-6">
                            <h2>CATEGORIA</h2>
                            <select id="categoria-select" name="categoria_id" class="category-select">
                                <option value="">TODAS LAS CATEGORIAS</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}"
                                        {{ request('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sub-Filtros dinámicos -->
                        <div id="subfiltros-container" class="mb-6 hidden">
                            <h2>FILTROS ADICIONALES</h2>
                            <div id="subfiltros-list" class="space-y-2"></div>
                        </div>

                        <!-- Botones de Filtrar y Limpiar -->
                        <div class="flex space-x-2 mt-6">
                            <button type="button" id="filter-button" class="filter-button w-1/2">FILTRAR</button>
                            <a href="{{ url('productos') }}" class="clear-button w-1/2 text-center">LIMPIAR</a>
                        </div>
                    </form>

                    <!-- Sección Top de Ventas -->
                    <div class="top-sales mt-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">TOP DE VENTAS</h2>
                        <ul id="top-sales-list" class="space-y-4">
                            @foreach ($topVentas as $producto)
                                <li class="flex items-center space-x-4 border-b pb-3">
                                    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}"
                                        class="flex items-center space-x-4">
                                        <img src="{{ asset('images/' . $producto->imagen_url) }}" class="top-sales-img">
                                        <div class="top-sales-info">
                                            <p class="top-sales-name">{{ $producto->nombre }}</p>
                                            <p class="top-sales-price">${{ number_format($producto->precio_dolares, 2) }}
                                            </p>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Contenido Principal (Productos) -->
            <div class="w-full md:w-3/4 p-4">
                <!-- Selectores de cantidad y vista -->
                <div class="products-controls mb-4">
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
                            <option value="grid" {{ request('view_mode', 'grid') == 'grid' ? 'selected' : '' }}>
                                Cuadrícula</option>
                            <option value="list" {{ request('view_mode') == 'list' ? 'selected' : '' }}>Lista</option>
                        </select>
                    </div>
                </div>

                <!-- Contenedor de productos -->
                <div id="product-container" class="products-wrapper">
                    @foreach ($productos as $producto)
                        <div class="product-card-specific">
                            <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}"
                                class="product-image-link">
                                <img src="{{ asset('images/' . $producto->imagen_url) }}" class="product-image-specific"
                                    alt="{{ $producto->nombre }}" loading="lazy">
                            </a>
                            <div class="product-body-specific">
                                <h2 class="product-title-specific">{{ $producto->nombre }}</h2>
                                <div class="product-price-specific">
                                    <span class="price-usd">${{ number_format($producto->precio_dolares, 2) }}</span>
                                    <span class="price-pen">S/. {{ number_format($producto->precio_soles, 2) }}</span>
                                </div>
                                <div class="product-card__actions">
                                    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}"
                                       class="btn-product-details">
                                       <span class="btn-product-details__text">Ver detalles</span>
                                       <span class="btn-product-details__icon">→</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Contenedor de paginación -->
                <div id="pagination-container" class="custom-pagination mt-4">
                    {!! $productos->appends(request()->query())->links('pagination::bootstrap-4') !!}
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
    <script src="{{ asset('js/ecommerce.js') }}"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.filters-wrapper').classList.toggle('show');
        }

        // Cierra el sidebar al hacer clic fuera de él
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.filters-wrapper');
            const toggleBtn = document.querySelector('.sidebar-toggle');

            if (!sidebar.contains(event.target) && event.target !== toggleBtn && !toggleBtn.contains(event
                .target)) {
                sidebar.classList.remove('show');
            }
        });
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.querySelector(".filters-wrapper");
            const overlay = document.createElement("div");
            overlay.classList.add("sidebar-overlay");
            document.body.appendChild(overlay);

            // Botón para abrir
            document.querySelector(".sidebar-toggle").addEventListener("click", function() {
                sidebar.classList.add("show");
                overlay.classList.add("active");
            });

            // Cerrar al hacer clic fuera
            overlay.addEventListener("click", function() {
                sidebar.classList.remove("show");
                overlay.classList.remove("active");
            });

            // Botón de cerrar
            const closeButton = document.createElement("button");
            closeButton.innerText = "X";
            closeButton.classList.add("sidebar-close");
            sidebar.appendChild(closeButton);

            closeButton.addEventListener("click", function() {
                sidebar.classList.remove("show");
                overlay.classList.remove("active");
            });
        });
    </script>
<script>
    function changeViewMode(mode) {
    const container = document.getElementById('product-container');
    if (mode === 'list') {
        container.classList.add('list-view');
    } else {
        container.classList.remove('list-view');
    }
    // Opcional: Guardar preferencia en localStorage
    localStorage.setItem('viewMode', mode);
    }


    document.addEventListener('DOMContentLoaded', function() {
    const savedMode = localStorage.getItem('viewMode') || 'grid';
    changeViewMode(savedMode);
    document.getElementById('view_mode').value = savedMode;
    });

    function updatePerPage(value) {
    // Lógica para actualizar productos por página
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', value);
    window.location.href = url.toString();
    }
</script>
@endsection
