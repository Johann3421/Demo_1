<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

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
                            <h2>FILTER BY PRICE</h2>
                            <div class="price-container">
                                <span id="price-label">${{ request('max_price', 0) }}</span>
                                <span>$5000</span>
                            </div>
                            <input type="range" id="price" name="max_price" min="0" max="5000"
                                step="1" value="{{ request('max_price', 5000) }}" class="price-range w-full mt-2">
                        </div>

                        <!-- Filtro de Categoría -->
                        <div class="mb-6">
                            <h2>CATEGORY</h2>
                            <select id="categoria-select" name="categoria_id" class="category-select">
                                <option value="">All Categories</option>
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
                            <h2>ADDITIONAL FILTERS</h2>
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
                                <p class="product-text-specific">{{ $producto->descripcion }}</p>
                                <div class="product-price-specific">
                                    <span class="price-usd">${{ number_format($producto->precio_dolares, 2) }}</span>
                                    <span class="price-pen">S/. {{ number_format($producto->precio_soles, 2) }}</span>
                                </div>
                                <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}"
                                    class="btn btn-primary">Ver Detalles</a>
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
    <style>
        /* =============================
            📌 CONFIGURACIONES GENERALES
        ============================= */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8fafc;
            color: #1e293b;
            line-height: 1.6;
        }

        /* =============================
            📌 CONTENEDOR PRINCIPAL
        ============================= */
        .main-wrapper {
            max-width: 1800px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        /* =============================
            📌 BOTÓN FILTROS MÓVIL
        ============================= */
        .sidebar-toggle {
            display: none;
        }

        @media (max-width: 768px) {
            .sidebar-toggle {
                display: block;
                width: 100%;
                background: #f97316;
                color: white;
                padding: 12px 16px;
                border-radius: 8px;
                position: sticky;
                top: 0;
                z-index: 40;
                margin-bottom: 1rem;
                font-weight: 500;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                border: none;
                cursor: pointer;
            }

            .sidebar-toggle:hover {
                background: #ea580c;
            }
        }

        /* =============================
            📌 SIDEBAR (FILTROS)
        ============================= */
        .filters-wrapper {
            width: 100%;
            padding: 1.5rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .filters-wrapper h2 {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: #1e293b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .price-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            color: #64748b;
        }

        .price-range {
            -webkit-appearance: none;
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #e2e8f0;
            outline: none;
            margin: 1rem 0;
        }

        .price-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #f97316;
            cursor: pointer;
            transition: all 0.2s;
        }

        .price-range::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #f97316;
            cursor: pointer;
        }

        .category-select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
            color: #334155;
            font-size: 0.95rem;
            transition: border-color 0.2s;
        }

        .category-select:focus {
            border-color: #f97316;
            outline: none;
        }

        #subfiltros-container {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e2e8f0;
        }

        /* Botones de filtros */
        .filter-button {
            background-color: #f97316;
            color: white;
            padding: 0.75rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            text-align: center;
        }

        .filter-button:hover {
            background-color: #ea580c;
            transform: translateY(-1px);
        }

        .clear-button {
            background-color: #f1f5f9;
            color: #334155;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            text-align: center;
            text-decoration: none;
            display: block;
        }

        .clear-button:hover {
            background-color: #e2e8f0;
            text-decoration: none;
        }

        /* =============================
            📌 SECCIÓN TOP VENTAS
        ============================= */
        .top-sales {
            margin-top: 2rem;
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .top-sales h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 1.25rem;
            padding-bottom: 0.75rem;
            border-bottom: 1px solid #e2e8f0;
        }

        #top-sales-list {
            list-style: none;
        }

        #top-sales-list li {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
            transition: background-color 0.2s;
        }

        #top-sales-list li:last-child {
            border-bottom: none;
        }

        #top-sales-list li:hover {
            background-color: #f8fafc;
        }

        .top-sales-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #f1f5f9;
            transition: transform 0.2s;
        }

        #top-sales-list li:hover .top-sales-img {
            transform: scale(1.05);
        }

        .top-sales-info {
            margin-left: 1rem;
        }

        .top-sales-name {
            font-weight: 500;
            color: #1e293b;
            margin-bottom: 0.25rem;
            transition: color 0.2s;
        }

        #top-sales-list li:hover .top-sales-name {
            color: #f97316;
        }

        .top-sales-price {
            font-weight: 600;
            color: #f97316;
            font-size: 1rem;
        }

        /* =============================
            📌 CONTENIDO PRINCIPAL
        ============================= */
        .products-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            margin-bottom: 1.5rem;
        }

        .per-page-selector,
        .view-selector {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .per-page-selector label,
        .view-selector label {
            color: #64748b;
            font-size: 0.95rem;
        }

        .per-page-selector select,
        .view-selector select {
            padding: 0.5rem 0.75rem;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
            color: #334155;
            font-size: 0.95rem;
        }

        /* =============================
            📌 GRID DE PRODUCTOS
        ============================= */
        .products-wrapper {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .product-card-specific {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .product-card-specific:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .product-image-specific {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card-specific:hover .product-image-specific {
            transform: scale(1.03);
        }

        .product-body-specific {
            padding: 1.25rem;
        }

        .product-title-specific {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 0.5rem;
        }

        .product-text-specific {
            font-size: 0.9rem;
            color: #64748b;
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .product-price-specific {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.25rem;
        }

        .price-usd {
            font-weight: 700;
            color: #f97316;
            font-size: 1.2rem;
        }

        .price-pen {
            font-weight: 500;
            color: #64748b;
            font-size: 0.95rem;
        }

        .btn-primary {
            display: block;
            text-align: center;
            background-color: #f97316;
            color: white;
            padding: 0.75rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #ea580c;
            text-decoration: none;
        }

        /* =============================
            📌 PAGINACIÓN
        ============================= */
        #pagination-container {
            margin-top: 2rem;
            text-align: center;
        }

        #pagination-container ul {
            display: inline-flex;
            list-style: none;
        }

        #pagination-container li {
            margin: 0 0.25rem;
        }

        #pagination-container a,
        #pagination-container span {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: #f1f5f9;
            color: #334155;
            text-decoration: none;
            transition: all 0.2s;
        }

        #pagination-container a:hover {
            background: #e2e8f0;
            color: #f97316;
        }

        #pagination-container .active span {
            background: #f97316;
            color: white;
        }

        /* =============================
            📌 RESPONSIVE DESIGN
        ============================= */
        @media (max-width: 1024px) {
            .products-wrapper {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {


            .products-controls {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }

            .products-wrapper {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 480px) {
            .product-price-specific {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
        }
    </style>
    <style>
        /* =============================
            📌 CORRECCIÓN RESPONSIVE GENERAL
        ============================= */
        @media (max-width: 768px) {

            /* Fuerza el responsive en todas las páginas de productos */
            body .main-wrapper .flex.flex-col.md\:flex-row {
                flex-direction: column !important;
            }

            body .main-wrapper .w-full.md\:w-1\/4,
            body .main-wrapper .w-full.md\:w-3\/4 {
                width: 100% !important;
                padding: 0 !important;
            }
        }

        /* =============================
            📌 CORRECCIÓN SIDEBAR FILTROS
        ============================= */
        .filters-wrapper {
            position: relative;
            z-index: 30;
        }

        @media (max-width: 768px) {

            /* Contenedor del sidebar */
            .filters-wrapper {
                position: fixed;
                top: 0;
                left: -85%;
                /* Inicialmente oculto */
                width: 85%;
                max-width: 400px;
                /* Evitar que sea demasiado grande */
                height: 100vh;
                overflow-y: auto;
                background: white;
                padding: 1.5rem;
                box-shadow: 2px 0 15px rgba(0, 0, 0, 0.1);
                transition: left 0.3s ease;
                z-index: 200;
            }

            /* Clase para mostrar el sidebar */
            .filters-wrapper.show {
                left: 0;
            }

            /* Fondo oscuro al abrir el sidebar */
            .sidebar-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                /* Transparente */
                z-index: 150;
                display: none;
            }

            /* Mostrar overlay cuando el sidebar está activo */
            .sidebar-overlay.active {
                display: block;
            }

            /* Botón para cerrar el sidebar */
            .sidebar-close {
                position: absolute;
                top: 10px;
                right: 15px;
                background: #ff5722;
                color: white;
                border: none;
                padding: 8px 12px;
                cursor: pointer;
                border-radius: 5px;
            }


            /* Asegura que el contenido principal no se desplace */
            .main-wrapper>.flex>.w-full.md\:w-3\/4 {
                margin-top: 0 !important;
            }
        }

        /* =============================
            📌 TOP VENTAS SIN SUBRAYADO
        ============================= */
        #top-sales-list li a {
            text-decoration: none !important;
        }

        /* =============================
            📌 BOTONES AZULES (#0037ff)
        ============================= */
        .filter-button,
        .btn-primary,
        .sidebar-toggle {
            background-color: #0037ff !important;
            color: white !important;
            border: none !important;
        }

        .filter-button:hover,
        .btn-primary:hover,
        .sidebar-toggle:hover {
            background-color: #0026b3 !important;
        }

        .price-range::-webkit-slider-thumb {
            background: #0037ff !important;
        }

        .price-range::-moz-range-thumb {
            background: #0037ff !important;
        }

        /* =============================
            📌 COLOR PRECIO TOP VENTAS
        ============================= */
        .top-sales-price {
            color: #0037ff !important;
        }

        /* =============================
            📌 PAGINACIÓN ACTIVA AZUL
        ============================= */
        #pagination-container .page-item.active .page-link {
            background-color: #0037ff !important;
            border-color: #0037ff !important;
        }
    </style>
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
@endsection
