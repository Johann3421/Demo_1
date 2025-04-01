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
