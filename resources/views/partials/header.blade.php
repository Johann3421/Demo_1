<header class="header shadow-sm py-3" style="background-color: #f8f9fa !important;">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo-link">
            <img src="{{ asset('images/logo_actualizado.png') }}" alt="Logo" class="logo">
        </a>

        <!-- Menú de navegación (Desktop) -->
        <nav class="desktop-nav">
            <!-- Buscador más ancho -->
            <div class="search-container">
                @include('partials.search')
            </div>
            
            <!-- Contenedor de iconos -->
            <div class="header-icons">
                <!-- Contenedor del dólar -->
                <div class="dolar-box">
                    <div class="dolar-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="dolar-info">
                        <span class="dolar-label">Dólar:</span>
                        <span id="precioDolarHeader" class="dolar-precio">S/ {{ $precio_dolar }}</span>
                    </div>
                </div>
                
                <!-- Icono de inicio movido a la derecha -->
                <a href="{{ route('home') }}" class="header-icon home-icon" title="Ir al inicio">
                    <i class="fas fa-home"></i>
                </a>
                
                <!-- Iconos sociales con color negro -->
                <div class="social-icons">
                    <a href="https://facebook.com/tu-pagina" target="_blank" class="social-icon">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://instagram.com/tu-pagina" target="_blank" class="social-icon">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://twitter.com/tu-pagina" target="_blank" class="social-icon">
                        <i class="fab fa-twitter"></i>
                    </a>
                </div>
            </div>
        </nav>

        <!-- Botón de menú móvil -->
        <button class="mobile-menu-toggle" type="button" id="mobileMenuButton">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Menú Responsive (Offcanvas) -->
<div class="mobile-menu" id="mobileMenu">
    <div class="mobile-menu-header">
        <h5 class="mobile-menu-title">Menú</h5>
        <button type="button" class="mobile-menu-close" id="mobileMenuClose">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="mobile-menu-body">
        <nav class="mobile-nav">
            <!-- Buscador en móvil -->
            <div class="search-container">
                @include('partials.search')
            </div>

            <!-- Iconos en horizontal -->
            <div class="mobile-social-icons">
                <a href="{{ route('home') }}" class="mobile-nav-link"><i class="fas fa-home"></i> Inicio</a>
                <a href="https://facebook.com/tu-pagina" target="_blank" class="mobile-nav-link"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/tu-pagina" target="_blank" class="mobile-nav-link"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/tu-pagina" target="_blank" class="mobile-nav-link"><i class="fab fa-twitter"></i></a>
            </div>

            <!-- Botón de contacto -->
            <a href="https://wa.me/+51987654321?text=Quisiera%20consultar%20sus%20productos" class="contact-button">Contacto</a>
        </nav>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenuClose = document.getElementById('mobileMenuClose');
    const mobileMenu = document.getElementById('mobileMenu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.add('open');
    });

    mobileMenuClose.addEventListener('click', function() {
        mobileMenu.classList.remove('open');
    });
});
</script>
