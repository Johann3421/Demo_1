<header class="header shadow-sm py-3" style="background-color: #f8f9fa !important;">
    <div class="container">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="logo-link">
            <img src="{{ asset('images/logo_actualizado.png') }}" alt="Logo" class="logo">
        </a>

        <!-- Menú de navegación (Desktop) - Visible solo desde 1120px -->
        <nav class="desktop-nav">
            <!-- Buscador más ancho -->
            <div class="search-container">
                @include('partials.search')
            </div>

            <!-- Iconos en horizontal -->
            <div class="social-icons">
                <a href="https://facebook.com/tu-pagina" target="_blank" class="nav-link">
                    <i class="fab fa-facebook"></i>
                </a>
                <a href="https://instagram.com/tu-pagina" target="_blank" class="nav-link">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://twitter.com/tu-pagina" target="_blank" class="nav-link">
                    <i class="fab fa-twitter"></i>
                </a>
            </div>
        </nav>

        <!-- Botón de menú para móviles - Visible hasta 1119px -->
        <button class="mobile-menu-toggle" type="button" id="mobileMenuButton">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Menú Responsive (Offcanvas) - Funciona hasta 1119px -->
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
            <div class="social-icons">
                <a href="https://facebook.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-facebook"></i></a>
                <a href="https://instagram.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-twitter"></i></a>
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
