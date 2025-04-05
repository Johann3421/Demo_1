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
                        <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-toggle">
                            <i class="fas fa-folder"></i> <!-- Icono por defecto -->
                            <span class="menu-label">{{ $categoria->nombre }}</span>
                        </a>
                        <!-- Menú desplegable de grupos -->
                        <div class="grupos-dropdown">
                            <ul class="grupos-list">
                                @foreach ($categoria->grupos as $grupo)
                                <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                    <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}" class="grupo-link">{{ $grupo->nombre }}</a>
                                    <!-- Menú desplegable de subgrupos -->
                                    <ul class="subgrupos-list">
                                        @foreach ($grupo->subgrupos as $subgrupo)
                                        <li><a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a></li>
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
                            <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-link">{{ $categoria->nombre }}</a>
                            <div class="submenu">
                                <ul class="submenu-list">
                                    @foreach ($categoria->grupos as $grupo)
                                    <li class="has-submenu">
                                        <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">{{ $grupo->nombre }}</a>
                                        <!-- Sub-submenú para los subgrupos -->
                                        <div class="sub-submenu">
                                            <ul class="sub-submenu-list">
                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                <li><a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a></li>
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
<div class="header-row sticky-header-clone">
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
                        <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-toggle">
                            <i class="fas fa-folder"></i> <!-- Icono por defecto -->
                            <span class="menu-label">{{ $categoria->nombre }}</span>
                        </a>
                        <!-- Menú desplegable de grupos -->
                        <div class="grupos-dropdown">
                            <ul class="grupos-list">
                                @foreach ($categoria->grupos as $grupo)
                                <li class="grupo-item" data-grupo="{{ $grupo->nombre }}">
                                    <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}" class="grupo-link">{{ $grupo->nombre }}</a>
                                    <!-- Menú desplegable de subgrupos -->
                                    <ul class="subgrupos-list">
                                        @foreach ($grupo->subgrupos as $subgrupo)
                                        <li><a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a></li>
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
                            <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="menu-link">{{ $categoria->nombre }}</a>
                            <div class="submenu">
                                <ul class="submenu-list">
                                    @foreach ($categoria->grupos as $grupo)
                                    <li class="has-submenu">
                                        <a href="{{ route('products.by.grupo', ['grupo' => $grupo->nombre]) }}">{{ $grupo->nombre }}</a>
                                        <!-- Sub-submenú para los subgrupos -->
                                        <div class="sub-submenu">
                                            <ul class="sub-submenu-list">
                                                @foreach ($grupo->subgrupos as $subgrupo)
                                                <li><a href="{{ route('products.by.subgrupo', ['subgrupo' => $subgrupo->nombre]) }}">{{ $subgrupo->nombre }}</a></li>
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
            const submenuItemsWithSubmenu = item.querySelectorAll(".has-submenu > .submenu .has-submenu");
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
    /* CSS para el sticky header */
.sticky-header-clone {
    position: fixed;
    top: -100%;
    left: 0;
    width: 100%;
    background: #0033ff;
    box-shadow: 0 2px 15px rgba(0,0,0,0.1);
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

/* Asegura espacio cuando el sticky está activo */
body.sticky-active {
    padding-top: 60px; /* Ajusta según altura de tu header */
}

/* Mantén tus estilos originales y añade: */
.sticky-header {
    transition: transform 0.3s ease;
}

.sticky-header.hide {
    transform: translateY(-100%);
}
</style>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Tu código JavaScript original se mantiene igual
        // ... (todo el código que ya tenías) ...

        // ========== NUEVO CÓDIGO PARA STICKY HEADER ==========
        const originalHeader = document.querySelector('.sticky-header');
        const cloneHeader = document.querySelector('.sticky-header-clone');
        const headerHeight = originalHeader.offsetHeight;

        // Clonar todo el contenido manteniendo eventos
        const originalContent = document.querySelector('.header-inner').innerHTML;
        cloneHeader.querySelector('.header-inner').innerHTML = originalContent;

        // Control del scroll
        let lastScroll = 0;
        const scrollThreshold = 100; // Pixeles antes de activar

        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;

            // Mostrar clon al bajar
            if (currentScroll > scrollThreshold && currentScroll > lastScroll) {
                document.body.classList.add('sticky-active');
                cloneHeader.classList.add('active');
                originalHeader.classList.add('hide');
            }
            // Ocultar al subir
            else if (currentScroll < scrollThreshold/2) {
                document.body.classList.remove('sticky-active');
                cloneHeader.classList.remove('active');
                originalHeader.classList.remove('hide');
            }

            lastScroll = currentScroll;
        });

        // Re-inicializar eventos para el clon
        function initCloneEvents() {
            // Menú móvil clonado
            const menuToggleClone = cloneHeader.querySelector(".menu-toggle.categorias");
            const menuDropdownClone = cloneHeader.querySelector(".menu-dropdown");
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

            // Cerrar menús clonados
            overlayClone.addEventListener("click", function() {
                menuDropdownClone.classList.remove("active");
                setTimeout(() => {
                    menuDropdownClone.style.display = "none";
                }, 400);
                overlayClone.style.display = "none";
            });

            // Hover para desktop en clon
            const menuContainersClone = cloneHeader.querySelectorAll('.menu-toggle-container');
            menuContainersClone.forEach(container => {
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
        }

        initCloneEvents();
    });
    </script>
