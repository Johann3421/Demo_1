<header class="header shadow-sm py-3 bg-light-custom">
    <div class="custom-container">
        <!-- Logo con preload -->
        <a href="{{ route('home') }}" class="logo-link" aria-label="Inicio">
            <img src="{{ asset('images/logo_actualizado.png') }}"
                 alt="Logo"
                 class="logo"
                 loading="lazy"
                 width="150"
                 height="50"
                 onload="this.style.opacity=1">
        </a>

        <!-- Menú de navegación (Desktop) -->
        <nav class="desktop-nav" aria-label="Navegación principal">
            <!-- Buscador -->
            <div class="search-container">
                @include('partials.search')
            </div>

            <!-- Contenedor de iconos -->
            <div class="header-icons">
                <!-- Dólar -->
                <div class="dolar-box" aria-label="Tipo de cambio">
                    <div class="dolar-icon" aria-hidden="true">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="dolar-info">
                        <span class="dolar-label">Dólar:</span>
                        <span id="precioDolarHeader" class="dolar-precio">S/ {{ $precio_dolar }}</span>
                    </div>
                </div>

                <!-- Inicio -->
                <a href="{{ route('home') }}" class="header-icon home-icon" title="Ir al inicio" aria-label="Inicio">
                    <i class="fas fa-home" aria-hidden="true"></i>
                </a>

                <!-- Redes sociales -->
                <div class="social-icons">
                    <a href="https://facebook.com/tu-pagina"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-icon"
                       aria-label="Facebook">
                        <i class="fab fa-facebook-f" aria-hidden="true"></i>
                    </a>
                    <a href="https://instagram.com/tu-pagina"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-icon"
                       aria-label="Instagram">
                        <i class="fab fa-instagram" aria-hidden="true"></i>
                    </a>
                    <a href="https://twitter.com/tu-pagina"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="social-icon"
                       aria-label="Twitter">
                        <i class="fab fa-twitter" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Botón móvil optimizado -->
        <button class="mobile-menu-toggle"
                type="button"
                id="mobileMenuButton"
                aria-label="Abrir menú"
                aria-expanded="false"
                aria-controls="mobileMenu">
            <i class="fas fa-bars" aria-hidden="true"></i>
        </button>
    </div>
</header>

<!-- Menú móvil optimizado -->
<div class="mobile-menu" id="mobileMenu" aria-hidden="true">
    <div class="mobile-menu-header">
        <h5 class="mobile-menu-title">Menú</h5>
        <button type="button"
                class="mobile-menu-close"
                id="mobileMenuClose"
                aria-label="Cerrar menú">
            <i class="fas fa-times" aria-hidden="true"></i>
        </button>
    </div>
    <div class="mobile-menu-body">
        <nav class="mobile-nav" aria-label="Navegación móvil">
            <!-- Buscador -->
            <div class="search-container">
                @include('partials.search')
            </div>

            <!-- Iconos -->
            <div class="mobile-social-icons">
                <a href="{{ route('home') }}" class="mobile-nav-link" aria-label="Inicio">
                    <i class="fas fa-home" aria-hidden="true"></i> Inicio
                </a>
                <a href="https://facebook.com/tu-pagina"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mobile-nav-link"
                   aria-label="Facebook">
                    <i class="fab fa-facebook-f" aria-hidden="true"></i>
                </a>
                <a href="https://instagram.com/tu-pagina"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mobile-nav-link"
                   aria-label="Instagram">
                    <i class="fab fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="https://twitter.com/tu-pagina"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="mobile-nav-link"
                   aria-label="Twitter">
                    <i class="fab fa-twitter" aria-hidden="true"></i>
                </a>
            </div>

            <!-- Contacto -->
            <a href="https://wa.me/+51987654321?text=Quisiera%20consultar%20sus%20productos"
               class="contact-button"
               aria-label="Contactar por WhatsApp">
                Contacto
            </a>
        </nav>
    </div>
</div>

<script defer>
    // Control del menú móvil optimizado
    const menuToggle = () => {
        const menu = document.getElementById('mobileMenu');
        if (!menu) return;

        const isOpen = menu.getAttribute('aria-hidden') === 'false';
        menu.setAttribute('aria-hidden', isOpen);
        document.getElementById('mobileMenuButton')?.setAttribute('aria-expanded', !isOpen);
        menu.classList.toggle('open', !isOpen);
        document.body.style.overflow = isOpen ? '' : 'hidden';
    };

    document.getElementById('mobileMenuButton')?.addEventListener('click', menuToggle);
    document.getElementById('mobileMenuClose')?.addEventListener('click', menuToggle);
</script>
