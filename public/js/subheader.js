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
