<div class="header-row sticky-header">
    <div class="custom-container">
        <div class="header-inner">
            <div class="menu-wrapper">
                <!-- Botón de Categorías (SIEMPRE visible) -->
                <span class="menu-toggle categorias" id="menuButton">
                    <i class="fas fa-bars"></i>
                    <span class="menu-label">Categorías</span>
                </span>
                <!-- Componentes con Iconos SOLO EN PC -->
                <div class="pc-only">
                    @if ($categorias && $categorias->count() > 0)
                        @foreach ($categorias as $categoria)
                            <div class="menu-toggle-container" data-categoria="{{ $categoria->nombre }}">
                                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}"
                                    class="menu-toggle">
                                    <i class="fas fa-folder"></i> <!-- Icono por defecto -->
                                    <span class="menu-label">{{ $categoria->nombre }}</span>
                                </a>
                                <!-- Menú desplegable de grupos -->
                                <div class="grupos-dropdown">
                                    <ul class="grupos-list">
                                        @foreach ($categoria->grupos as $grupo)
                                            <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                                <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}"
                                                    class="grupo-link">{{ $grupo->nombre }}</a>
                                                <!-- Menú desplegable de subgrupos -->
                                                <ul class="subgrupos-list">
                                                    @foreach ($grupo->subgrupos as $subgrupo)
                                                        <li><a
                                                                href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="menu-toggle">
                            <i class="fas fa-folder"></i>
                            <span class="menu-label">No hay categorías</span>
                        </span>
                    @endif
                </div>
                <!-- Menú lateral en móvil -->
                <div class="menu-dropdown" id="mobileMenu">
                    <ul class="menu-list">
                        @if ($categorias && $categorias->count() > 0)
                            @foreach ($categorias as $categoria)
                                <li class="menu-item has-submenu">
                                    <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}"
                                        class="menu-link">{{ $categoria->nombre }}</a>
                                    <div class="submenu">
                                        <ul class="submenu-list">
                                            @foreach ($categoria->grupos as $grupo)
                                                <li class="has-submenu">
                                                    <a
                                                        href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">{{ $grupo->nombre }}</a>
                                                    <!-- Sub-submenú para los subgrupos -->
                                                    <div class="sub-submenu">
                                                        <ul class="sub-submenu-list">
                                                            @foreach ($grupo->subgrupos as $subgrupo)
                                                                <li><a
                                                                        href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="menu-item">
                                <a href="#">No hay categorías</a>
                            </li>
                        @endif
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
                <!-- Contenido clonado igual al original -->
                <span class="menu-toggle categorias" id="menuButtonClone">
                    <i class="fas fa-bars"></i>
                    <span class="menu-label">Categorías</span>
                </span>
                <!-- Componentes con Iconos SOLO EN PC -->
                <div class="pc-only">
                    @if ($categorias && $categorias->count() > 0)
                        @foreach ($categorias as $categoria)
                            <div class="menu-toggle-container" data-categoria="{{ $categoria->nombre }}">
                                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}"
                                    class="menu-toggle">
                                    <i class="fas fa-folder"></i> <!-- Icono por defecto -->
                                    <span class="menu-label">{{ $categoria->nombre }}</span>
                                </a>
                                <!-- Menú desplegable de grupos -->
                                <div class="grupos-dropdown">
                                    <ul class="grupos-list">
                                        @foreach ($categoria->grupos as $grupo)
                                            <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                                <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}"
                                                    class="grupo-link">{{ $grupo->nombre }}</a>
                                                <!-- Menú desplegable de subgrupos -->
                                                <ul class="subgrupos-list">
                                                    @foreach ($grupo->subgrupos as $subgrupo)
                                                        <li><a
                                                                href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <span class="menu-toggle">
                            <i class="fas fa-folder"></i>
                            <span class="menu-label">No hay categorías</span>
                        </span>
                    @endif
                </div>
                <!-- Menú lateral en móvil -->
                <div class="menu-dropdown" id="mobileMenu">
                    <ul class="menu-list">
                        @if ($categorias && $categorias->count() > 0)
                            @foreach ($categorias as $categoria)
                                <li class="menu-item has-submenu">
                                    <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}"
                                        class="menu-link">{{ $categoria->nombre }}</a>
                                    <div class="submenu">
                                        <ul class="submenu-list">
                                            @foreach ($categoria->grupos as $grupo)
                                                <li class="has-submenu">
                                                    <a
                                                        href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">{{ $grupo->nombre }}</a>
                                                    <!-- Sub-submenú para los subgrupos -->
                                                    <div class="sub-submenu">
                                                        <ul class="sub-submenu-list">
                                                            @foreach ($grupo->subgrupos as $subgrupo)
                                                                <li><a
                                                                        href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="menu-item">
                                <a href="#">No hay categorías</a>
                            </li>
                        @endif
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
            <!-- Botón menú (izquierda) -->
            <button class="mobile-nav-toggle" id="mobileMenuButtonClone">
                <i class="fas fa-align-left"></i>
            </button>

            <!-- Logo centrado -->
            <div class="mobile-logo-wrapper">
                <img src="{{ asset('images/logo_actualizado.png') }}" alt="Logo" class="mobile-main-logo">
            </div>

            <!-- Botón búsqueda (derecha) -->
            <button class="mobile-search-trigger" id="mobileSearchButton">
                <i class="fas fa-search"></i>
            </button>

            <!-- Contenedor buscador -->
            <div class="mobile-search-wrapper" id="mobileSearchContainer">
                @include('partials.search')
            </div>
        </div>
    </div>

    <!-- Menú de categorías móvil (oculto inicialmente) -->
    <div class="mobile-categories-menu" id="mobileCategoriesMenu">
        <div class="mobile-menu-header">
            <h3>Categorías</h3>
            <button class="close-menu-btn" id="closeMenuBtn">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-menu-content">
            @if ($categorias && $categorias->count() > 0)
                <ul class="mobile-categories-list">
                    @foreach ($categorias as $categoria)
                        <li class="mobile-category-item">
                            <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}"
                                class="mobile-category-link">
                                {{ $categoria->nombre }}
                            </a>
                            @if ($categoria->grupos->count() > 0)
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
                    @endforeach
                </ul>
            @else
                <p class="no-categories">No hay categorías disponibles</p>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mapeo de categorías a iconos
        const categoriaIconos = {
            "Laptops": "fa-laptop",
            "Computadoras": "fa-desktop",
            "Componentes para PC": "fa-memory",
            "Monitores": "fa-tv",
            "Impresoras": "fa-print",
            // Agrega más categorías y sus iconos aquí
        };

        // Asignar iconos a categorías en versión desktop
        const menuTogglesDesktop = document.querySelectorAll(".menu-toggle-container[data-categoria]");
        menuTogglesDesktop.forEach((toggle) => {
            const categoria = toggle.getAttribute("data-categoria");
            const iconElement = toggle.querySelector("i");

            if (categoriaIconos[categoria]) {
                iconElement.classList.remove("fa-folder");
                iconElement.classList.add(categoriaIconos[categoria]);
            }
        });

        // Menú móvil
        const menuToggle = document.querySelector(".menu-toggle.categorias");
        const menuDropdown = document.querySelector(".menu-dropdown");
        const overlay = document.createElement("div");

        overlay.classList.add("overlay");
        document.body.appendChild(overlay);

        // Función para abrir/cerrar el menú principal
        menuToggle.addEventListener("click", function(e) {
            e.stopPropagation();
            const isActive = menuDropdown.classList.contains("active");

            if (isActive) {
                menuDropdown.classList.remove("active");
                overlay.style.display = "none";
            } else {
                menuDropdown.style.display = "block";
                setTimeout(() => {
                    menuDropdown.classList.add("active");
                }, 10);
                overlay.style.display = "block";
            }
        });

        // Cerrar menús
        overlay.addEventListener("click", function() {
            menuDropdown.classList.remove("active");
            setTimeout(() => {
                menuDropdown.style.display = "none";
            }, 400);
            overlay.style.display = "none";
        });

        document.addEventListener("click", function(e) {
            if (!menuDropdown.contains(e.target)) {
                menuDropdown.classList.remove("active");
                overlay.style.display = "none";
            }
        });

        // Manejar submenús en móviles
        const menuItemsWithSubmenu = document.querySelectorAll(".menu-item.has-submenu");
        menuItemsWithSubmenu.forEach((item) => {
            const menuLink = item.querySelector(".menu-link");
            const submenu = item.querySelector(".submenu");

            menuLink.addEventListener("click", function(e) {
                if (window.innerWidth <= 768) { // Solo en móvil
                    e.preventDefault();
                    submenu.classList.toggle("active");
                }
            });

            // Manejar sub-submenús en móviles
            const submenuItemsWithSubmenu = item.querySelectorAll(
                ".has-submenu > .submenu .has-submenu");
            submenuItemsWithSubmenu.forEach((subItem) => {
                const subMenuLink = subItem.querySelector("a");
                const subSubmenu = subItem.querySelector(".sub-submenu");

                subMenuLink.addEventListener("click", function(e) {
                    if (window.innerWidth <= 768) { // Solo en móvil
                        e.preventDefault();
                        subSubmenu.classList.toggle("active");
                    }
                });
            });
        });

        // Hover para desktop
        const menuContainers = document.querySelectorAll('.menu-toggle-container');
        menuContainers.forEach(container => {
            const dropdown = container.querySelector('.grupos-dropdown');

            container.addEventListener('mouseenter', () => {
                if (window.innerWidth > 768) {
                    dropdown.style.display = 'block';
                }
            });

            container.addEventListener('mouseleave', () => {
                if (window.innerWidth > 768) {
                    dropdown.style.display = 'none';
                }
            });
        });
    });
</script>

<style>
    /* STICKY HEADER BASE */
    .sticky-header-clone {
        position: fixed;
        top: -100%;
        left: 0;
        width: 100%;
        background: #0033ff;
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
        transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        opacity: 0;
        visibility: hidden;
    }

    .sticky-header-clone.active {
        top: 0;
        opacity: 1;
        visibility: visible;
    }

    /* ESPACIO PARA STICKY */
    body.sticky-active {
        padding-top: 60px;
    }

    /* HEADER ORIGINAL */
    .sticky-header {
        transition: transform 0.3s ease;
    }

    .sticky-header.hide {
        transform: translateY(-100%);
    }

    /* VISIBILIDAD POR DISPOSITIVO */
    .desktop-only {
        display: block;
    }

    .mobile-only {
        display: none;
    }

    /* HEADER MÓVIL - ESTILO OPTIMIZADO */
    @media (max-width: 991.98px) {
        .mobile-header-wrap {
            width: 100%;
            height: 100%;
            margin: 0 auto;
            padding: 0 15px;
        }

        .sticky-header-clone.mobile-only {
            height: 60px;
            background: white;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid #f0f0f0;
        }

        .header-inner-mobile {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 100%;
            position: relative;
        }

        /* Botón menú izquierdo */
        .mobile-nav-toggle {
            background: transparent;
            border: none;
            color: #333;
            font-size: 1.4rem;
            padding: 5px 10px;
            position: absolute;
            left: 5px;
            z-index: 10;
        }

        /* Contenedor logo */
        .mobile-logo-wrapper {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            pointer-events: none;
        }

        .mobile-main-logo {
            max-height: 35px;
            width: auto;
            max-width: 150px;
        }

        /* Botón búsqueda derecho */
        .mobile-search-trigger {
            background: transparent;
            border: none;
            color: #333;
            font-size: 1.3rem;
            padding: 5px 10px;
            position: absolute;
            right: 5px;
            z-index: 10;
        }

        /* Contenedor buscador */
        .mobile-search-wrapper {
            position: fixed;
            top: 60px;
            left: 0;
            width: 100%;
            background: white;
            padding: 15px;
            display: none;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .search-active .mobile-search-wrapper {
            display: block;
            animation: slideDown 0.3s ease-out;
        }

        /* MENÚ DE CATEGORÍAS MÓVIL */
        .mobile-categories-menu {
            position: fixed;
            top: 0;
            left: -100%;
            width: 85%;
            max-width: 350px;
            height: 100vh;
            background: white;
            z-index: 1100;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            overflow-y: auto;
        }

        .mobile-categories-menu.active {
            left: 0;
        }

        .mobile-menu-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            background: #0033ff;
            color: white;
        }

        .mobile-menu-header h3 {
            margin: 0;
            font-size: 1.2rem;
        }

        .close-menu-btn {
            background: none;
            border: none;
            color: white;
            font-size: 1.3rem;
        }

        .mobile-categories-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .mobile-category-item {
            border-bottom: 1px solid #eee;
        }

        .mobile-category-link {
            display: block;
            padding: 15px;
            color: #333;
            text-decoration: none;
            font-weight: 500;
        }

        .mobile-submenu {
            list-style: none;
            padding: 0;
            margin: 0;
            background: #f9f9f9;
            display: none;
        }

        .mobile-category-item.active .mobile-submenu {
            display: block;
        }

        .mobile-submenu-item a {
            display: block;
            padding: 12px 15px 12px 30px;
            color: #555;
            text-decoration: none;
        }

        .no-categories {
            padding: 20px;
            text-align: center;
            color: #777;
        }

        /* OVERLAY PARA FONDO OSCURO */
        .mobile-menu-overlay {

            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1099;
            display: none;
        }

        .menu-open .mobile-menu-overlay {
            display: block;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
    }
</style>

<!--SCRIPT PARA HEADER CLONADO (MÓVIL)-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Control del sticky header
        const originalHeader = document.querySelector('.sticky-header');
        const cloneMobile = document.querySelector('.sticky-header-clone.mobile-only');
        const headerHeight = originalHeader?.offsetHeight || 60;

        let lastScroll = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            const isMobile = window.innerWidth <= 991.98;

            if (isMobile && cloneMobile) {
                if (currentScroll > scrollThreshold && currentScroll > lastScroll) {
                    document.body.classList.add('sticky-active');
                    cloneMobile.classList.add('active');
                    if (originalHeader) originalHeader.classList.add('hide');
                } else if (currentScroll < scrollThreshold / 2) {
                    document.body.classList.remove('sticky-active');
                    cloneMobile.classList.remove('active');
                    if (originalHeader) originalHeader.classList.remove('hide');
                }
            }

            lastScroll = currentScroll;
        });

        // Control del menú móvil
        const menuButton = document.getElementById('mobileMenuButtonClone');
        const mobileMenu = document.getElementById('mobileCategoriesMenu');
        const overlay = document.createElement('div');
        overlay.className = 'mobile-menu-overlay';
        document.body.appendChild(overlay);

        if (menuButton && mobileMenu) {
            menuButton.addEventListener('click', function() {
                mobileMenu.classList.add('active');
                document.body.classList.add('menu-open');
                cloneMobile.classList.remove('search-active');
            });

            const closeMenuButton = document.getElementById('closeMenuBtn');
            if (closeMenuButton) {
                closeMenuButton.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    document.body.classList.remove('menu-open');
                });
            }

            overlay.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        }

        // Control del buscador móvil
        const searchButton = document.getElementById('mobileSearchButton');
        const searchContainer = document.getElementById('mobileSearchContainer');

        if (searchButton && searchContainer && cloneMobile) {
            searchButton.addEventListener('click', function() {
                cloneMobile.classList.toggle('search-active');
                if (mobileMenu) mobileMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });

            // Cerrar ambos al hacer scroll
            window.addEventListener('scroll', function() {
                cloneMobile.classList.remove('search-active');
                if (mobileMenu) mobileMenu.classList.remove('active');
                document.body.classList.remove('menu-open');
            });
        }

        // Control de submenús
        const categoryItems = document.querySelectorAll('.mobile-category-item');
        categoryItems.forEach(item => {
            const submenu = item.querySelector('.mobile-submenu');
            if (submenu) {
                const link = item.querySelector('.mobile-category-link');
                if (link) {
                    link.addEventListener('click', function(e) {
                        e.preventDefault();
                        item.classList.toggle('active');
                    });
                }
            }
        });
    });
</script>
<!--FIN SCRIPT PARA HEADER CLONADO (MÓVIL)-->

<!--SCRIPT PARA HEADER CLONADO (DESKTOP)-->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Elementos del header original y clonado
        const originalHeader = document.querySelector('.sticky-header');
        const cloneHeader = document.querySelector('.sticky-header-clone.desktop-only');

        if (!originalHeader || !cloneHeader) return;

        // Altura del header para cálculos
        const headerHeight = originalHeader.offsetHeight;

        // Clonar el contenido del header original al clon
        const originalContent = document.querySelector('.header-inner').innerHTML;
        cloneHeader.querySelector('.header-inner').innerHTML = originalContent;

        // Variables para control del scroll
        let lastScroll = 0;
        const scrollThreshold = 100; // Pixeles antes de activar el efecto

        // Función para manejar el scroll
        function handleScroll() {
            const currentScroll = window.pageYOffset;

            // Mostrar header clon al bajar
            if (currentScroll > scrollThreshold && currentScroll > lastScroll) {
                document.body.classList.add('sticky-active');
                cloneHeader.classList.add('active');
                originalHeader.classList.add('hide');
            }
            // Ocultar header clon al subir
            else if (currentScroll < scrollThreshold / 2) {
                document.body.classList.remove('sticky-active');
                cloneHeader.classList.remove('active');
                originalHeader.classList.remove('hide');
            }

            lastScroll = currentScroll;
        }

        // Evento de scroll
        window.addEventListener('scroll', handleScroll);

        // Inicializar eventos para el clon (menús hover, etc.)
        function initDesktopCloneEvents() {
            // Menú lateral clonado
            const menuToggleClone = cloneHeader.querySelector(".menu-toggle.categorias");
            const menuDropdownClone = cloneHeader.querySelector(".menu-dropdown");

            if (menuToggleClone && menuDropdownClone) {
                const overlayClone = document.createElement("div");
                overlayClone.classList.add("overlay");
                document.body.appendChild(overlayClone);

                menuToggleClone.addEventListener("click", function(e) {
                    e.stopPropagation();
                    const isActive = menuDropdownClone.classList.contains("active");

                    if (isActive) {
                        menuDropdownClone.classList.remove("active");
                        overlayClone.style.display = "none";
                    } else {
                        menuDropdownClone.style.display = "block";
                        setTimeout(() => {
                            menuDropdownClone.classList.add("active");
                        }, 10);
                        overlayClone.style.display = "block";
                    }
                });

                overlayClone.addEventListener("click", function() {
                    menuDropdownClone.classList.remove("active");
                    setTimeout(() => {
                        menuDropdownClone.style.display = "none";
                    }, 400);
                    overlayClone.style.display = "none";
                });
            }

            // Menús hover para desktop
            const menuContainersClone = cloneHeader.querySelectorAll('.menu-toggle-container');
            menuContainersClone.forEach(container => {
                const dropdown = container.querySelector('.grupos-dropdown');
                if (!dropdown) return;

                container.addEventListener('mouseenter', () => {
                    if (window.innerWidth > 768) {
                        dropdown.style.display = 'block';
                    }
                });

                container.addEventListener('mouseleave', () => {
                    if (window.innerWidth > 768) {
                        dropdown.style.display = 'none';
                    }
                });
            });
        }

        // Inicializar eventos del clon
        initDesktopCloneEvents();
    });
</script>
<!--FIN SCRIPT PARA HEADER CLONADO (DESKTOP)-->
