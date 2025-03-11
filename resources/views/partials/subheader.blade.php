<div class="header-row sticky-header">
    <div class="container">
        <div class="header-inner">
            <div class="menu-wrapper">
                <!-- Botón de Categorías (SIEMPRE visible) -->
                <span class="menu-toggle categorias" id="menuButton">
                    <i class="fas fa-bars"></i>
                    <span class="menu-label">Categorías</span>
                    
                </span>
                <!-- Componentes con Iconos SOLO EN PC -->
                <div class="pc-only">
                    <span class="menu-toggle">
                        <i class="fas fa-laptop"></i>
                        <span class="menu-label">Laptops</span>
                    </span>
                    <span class="menu-toggle">
                        <i class="fas fa-desktop"></i>
                        <span class="menu-label">Computadoras</span>
                    </span>
                    <span class="menu-toggle">
                        <i class="fas fa-memory"></i>
                        <span class="menu-label">Partes de PC</span>
                    </span>
                    <span class="menu-toggle">
                        <i class="fas fa-tv"></i>
                        <span class="menu-label">Monitores</span>
                    </span>
                    <span class="menu-toggle">
                        <i class="fas fa-print"></i>
                        <span class="menu-label">Impresoras</span>
                    </span>
                </div>
                <!-- Menú lateral en móvil -->
                <div class="menu-dropdown" id="mobileMenu">
                    <ul class="menu-list">
                        <li class="menu-item has-submenu">
                            <a href="#" class="menu-link">Computadoras</a>
                            <div class="submenu">
                                <ul class="submenu-list">
                                    <li><a href="#">All In One</a></li>
                                    <li><a href="#">PC Armada</a></li>
                                    <li><a href="#">Mini PC</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item has-submenu">
                            <a href="#" class="menu-link">Monitores</a>
                            <div class="submenu">
                                <ul class="submenu-list">
                                    <li><a href="#">Entrada</a></li>
                                    <li><a href="#">Gamer</a></li>
                                    <li><a href="#">Productividad</a></li>
                                    <li><a href="#">Empresarial</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item has-submenu">
                            <a href="#" class="menu-link">Impresoras</a>
                            <div class="submenu">
                                <ul class="submenu-list">
                                    <li><a href="#">HP</a></li>
                                    <li><a href="#">Epson</a></li>
                                    <li><a href="#">Escáneres</a></li>
                                    <li><a href="#">Suministros</a></li>
                                    <li><a href="#">Mantenimiento</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-item"><a href="#">Routers</a></li>
                        <li class="menu-item"><a href="#">Proyectores</a></li>
                        <li class="menu-item"><a href="#">Tablets</a></li>
                        <li class="menu-item"><a href="#">Tableta Gráfica</a></li>

                        <!-- Componentes con Iconos SOLO EN MÓVIL -->
                        <li class="menu-item mobile-only"><a href="#"><i class="fas fa-laptop"></i> Laptops</a></li>
                        <li class="menu-item mobile-only"><a href="#"><i class="fas fa-desktop"></i> Computadoras</a></li>
                        <li class="menu-item mobile-only"><a href="#"><i class="fas fa-memory"></i> Partes de PC</a></li>
                        <li class="menu-item mobile-only"><a href="#"><i class="fas fa-tv"></i> Monitores</a></li>
                        <li class="menu-item mobile-only"><a href="#"><i class="fas fa-print"></i> Impresoras</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        const menuToggle = document.querySelector(".menu-toggle");
        const menuDropdown = document.querySelector(".menu-dropdown");
        const menuLinks = document.querySelectorAll(".menu-item > .menu-link");
        const overlay = document.createElement("div");

        overlay.classList.add("overlay");
        document.body.appendChild(overlay);

        // Función para abrir/cerrar menú principal
        menuToggle.addEventListener("click", function() {
            const isActive = menuDropdown.classList.contains("active");

            if (isActive) {
                menuDropdown.classList.remove("active");
                overlay.style.display = "none";
            } else {
                menuDropdown.style.display = "block"; // Mostrar primero para iniciar la animación
                setTimeout(() => {
                    menuDropdown.classList.add("active");
                }, 10);
                overlay.style.display = "block";
            }
        });

        // Cerrar el menú principal al hacer clic en el overlay
        overlay.addEventListener("click", function() {
            menuDropdown.classList.remove("active");
            setTimeout(() => {
                menuDropdown.style.display = "none";
            }, 400);
            overlay.style.display = "none";
        });
    });
</script>