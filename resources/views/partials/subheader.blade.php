<div class="header-row sticky-header">
    <div class="container">
        <div class="header-inner">
            <div class="header-left lg-visible">
                <div class="menu-wrapper">
                    <span class="menu-toggle">
                        <span class="menu-icon"></span>
                        <span class="menu-label">Categorías</span>
                    </span>
                    <div class="menu-dropdown">
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
                            <li class="menu-item has-submenu">
                                <a href="#" class="menu-link">Componentes</a>
                                <div class="submenu">
                                    <ul class="submenu-list">
                                        <li><a href="#">Procesador</a></li>
                                        <li><a href="#">Placas Madre</a></li>
                                        <li><a href="#">Disco Duro</a></li>
                                        <li><a href="#">Disco Externo</a></li>
                                        <li><a href="#">Tarjeta de Video</a></li>
                                        <li><a href="#">Almacenamiento Sólido</a></li>
                                        <li><a href="#">Memoria RAM</a></li>
                                        <li><a href="#">Disipadores</a></li>
                                        <li><a href="#">Fuente de Poder</a></li>
                                        <li><a href="#">Case</a></li>
                                    </ul>
                                </div>
                            </li>
                            <li class="menu-item"><a href="#" class="menu-link">Routers</a></li>
                            <li class="menu-item"><a href="#" class="menu-link">Proyectores</a></li>
                            <li class="menu-item"><a href="#" class="menu-link">Tablets</a></li>
                            <li class="menu-item"><a href="#" class="menu-link">Tableta Gráfica</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menuDropdown = document.querySelector(".menu-dropdown");
    const menuLinks = document.querySelectorAll(".menu-item > .menu-link");
    const overlay = document.createElement("div");

    overlay.classList.add("overlay");
    document.body.appendChild(overlay);

    // Función para abrir/cerrar menú principal
    menuToggle.addEventListener("click", function () {
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
    overlay.addEventListener("click", function () {
        menuDropdown.classList.remove("active");
        setTimeout(() => {
            menuDropdown.style.display = "none";
        }, 400);
        overlay.style.display = "none";
    });

    // Función para abrir/cerrar submenús al hacer click en el menú-link
    menuLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Evita que el enlace redirija
            const submenu = this.nextElementSibling; // Obtiene el submenu correspondiente

            if (submenu && submenu.classList.contains("submenu")) {
                // Alternar clase "active" en el submenu
                submenu.classList.toggle("active");
                
                // Cerrar otros submenús abiertos
                document.querySelectorAll(".submenu").forEach(otherSubmenu => {
                    if (otherSubmenu !== submenu) {
                        otherSubmenu.classList.remove("active");
                    }
                });
            }
        });
    });
});


</script>