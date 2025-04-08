<link rel="stylesheet" href="{{ asset('css/subheader.css') }}">

<div class="header-row sticky-header">
    <div class="custom-container">
        <div class="header-inner">
            <div class="menu-wrapper">

                <span class="menu-toggle categorias" id="menuButton">
                    <i class="fas fa-bars"></i>
                    <span class="menu-label">Categorías</span>
                </span>

                <div class="pc-only">
                    @forelse ($categorias as $categoria)
                        <div class="menu-toggle-container" data-categoria="{{ $categoria->nombre }}">
                            <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-toggle">
                                <i class="fas fa-folder"></i>
                                <span class="menu-label">{{ $categoria->nombre }}</span>
                            </a>
                            <div class="grupos-dropdown">
                                <ul class="grupos-list">
                                    @foreach ($categoria->grupos as $grupo)
                                        <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                            <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}" class="grupo-link">
                                                {{ $grupo->nombre }}
                                            </a>
                                            <ul class="subgrupos-list">
                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                    <li>
                                                        <a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">
                                                            {{ $subgrupo->nombre }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @empty
                        <span class="menu-toggle">
                            <i class="fas fa-folder"></i>
                            <span class="menu-label">No hay categorías</span>
                        </span>
                    @endforelse
                </div>

                <div class="menu-dropdown" id="mobileMenu">
                    <ul class="menu-list">
                        @forelse ($categorias as $categoria)
                            <li class="menu-item has-submenu">
                                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-link">
                                    {{ $categoria->nombre }}
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-list">
                                        @foreach ($categoria->grupos as $grupo)
                                            <li class="has-submenu">
                                                <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">
                                                    {{ $grupo->nombre }}
                                                </a>
                                                <div class="sub-submenu">
                                                    <ul class="sub-submenu-list">
                                                        @foreach ($grupo->subgrupos as $subgrupo)
                                                            <li>
                                                                <a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">
                                                                    {{ $subgrupo->nombre }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @empty
                            <li class="menu-item">
                                <a href="#">No hay categorías</a>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- HEADER CLON (para sticky effect) -->
<div class="sticky-header-clone desktop-only">
    <div class="custom-container">
        <div class="header-inner">
            <div class="menu-wrapper">

                <span class="menu-toggle categorias" id="menuButtonClone">
                    <i class="fas fa-bars"></i>
                    <span class="menu-label">Categorías</span>
                </span>

                <div class="pc-only">
                    @forelse ($categorias as $categoria)
                        <div class="menu-toggle-container" data-categoria="{{ $categoria->nombre }}">
                            <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-toggle">
                                <i class="fas fa-folder"></i>
                                <span class="menu-label">{{ $categoria->nombre }}</span>
                            </a>
                            <div class="grupos-dropdown">
                                <ul class="grupos-list">
                                    @foreach ($categoria->grupos as $grupo)
                                        <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                            <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}" class="grupo-link">
                                                {{ $grupo->nombre }}
                                            </a>
                                            <ul class="subgrupos-list">
                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                    <li>
                                                        <a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">
                                                            {{ $subgrupo->nombre }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @empty
                        <span class="menu-toggle">
                            <i class="fas fa-folder"></i>
                            <span class="menu-label">No hay categorías</span>
                        </span>
                    @endforelse
                </div>

                <div class="menu-dropdown" id="mobileMenu">
                    <ul class="menu-list">
                        @forelse ($categorias as $categoria)
                            <li class="menu-item has-submenu">
                                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-link">
                                    {{ $categoria->nombre }}
                                </a>
                                <div class="submenu">
                                    <ul class="submenu-list">
                                        @foreach ($categoria->grupos as $grupo)
                                            <li class="has-submenu">
                                                <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">
                                                    {{ $grupo->nombre }}
                                                </a>
                                                <div class="sub-submenu">
                                                    <ul class="sub-submenu-list">
                                                        @foreach ($grupo->subgrupos as $subgrupo)
                                                            <li>
                                                                <a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">
                                                                    {{ $subgrupo->nombre }}
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                        @empty
                            <li class="menu-item">
                                <a href="#">No hay categorías</a>
                            </li>
                        @endforelse
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>


<!-- HEADER MÓVIL CON MENÚ Y BUSCADOR -->
<div class="sticky-header-clone mobile-only">
    <div class="mobile-header-wrap">
        <div class="header-inner-mobile">

            <button class="mobile-nav-toggle" id="mobileMenuButtonClone">
                <i class="fas fa-align-left"></i>
            </button>

            <div class="mobile-logo-wrapper">
                <img src="{{ asset('images/logo_actualizado.png') }}" alt="Logo" class="mobile-main-logo">
            </div>

            <button class="mobile-search-trigger" id="mobileSearchButton">
                <i class="fas fa-search"></i>
            </button>

            <div class="mobile-search-wrapper" id="mobileSearchContainer">
                @include('partials.search')
            </div>

        </div>
    </div>

    <div class="mobile-categories-menu" id="mobileCategoriesMenu">
        <div class="mobile-menu-header">
            <h3>Categorías</h3>
            <button class="close-menu-btn" id="closeMenuBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="mobile-menu-content">
            @forelse ($categorias as $categoria)
                <ul class="mobile-categories-list">
                    <li class="mobile-category-item">
                        <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="mobile-category-link">
                            {{ $categoria->nombre }}
                        </a>
                        @if ($categoria->grupos->isNotEmpty())
                            <ul class="mobile-submenu">
                                @foreach ($categoria->grupos as $grupo)
                                    <li class="mobile-submenu-item">
                                        <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">
                                            {{ $grupo->nombre }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                </ul>
            @empty
                <p class="no-categories">No hay categorías disponibles</p>
            @endforelse
        </div>
    </div>
</div>

<script src="{{ asset('js/subheader.js') }}"></script>

