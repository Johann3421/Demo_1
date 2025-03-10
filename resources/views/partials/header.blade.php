<header class="header shadow-sm py-3" style="background: linear-gradient(to bottom, #00c6ff, #ffffff) !important;">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('images/LOGO-SEKAITECH.png') }}" alt="Logo" class="logo me-3">
        </a>

        <!-- Menú de navegación (Desktop) - Visible solo desde 1120px -->
        <nav class="d-none d-lg-flex align-items-center gap-4">
            @include('partials.search')
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>
            <a href="https://facebook.com/tu-pagina" target="_blank" class="nav-link">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="https://instagram.com/tu-pagina" target="_blank" class="nav-link">
                <i class="fab fa-instagram"></i>
            </a>
            <a href="https://twitter.com/tu-pagina" target="_blank" class="nav-link">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="https://wa.me/+51987654321?text=Quisiera%20consultar%20sus%20productos" class="btn btn-primary ms-3">Contacto</a>
        </nav>

        <!-- Botón de menú para móviles - Visible hasta 1119px -->
        <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu">
            <i class="fas fa-bars"></i>
        </button>
    </div>
</header>

<!-- Menú Responsive (Offcanvas) - Funciona hasta 1119px -->
<div class="offcanvas offcanvas-start custom-gradient" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Menú</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="d-flex flex-column gap-2">
            @include('partials.search')
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>

            <div class="d-flex gap-3">
                <a href="https://facebook.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-facebook"></i></a>
                <a href="https://instagram.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/tu-pagina" target="_blank" class="nav-link"><i class="fab fa-twitter"></i></a>
            </div>

            <a href="https://wa.me/+51987654321?text=Quisiera%20consultar%20sus%20productos" class="btn btn-primary mt-2">Contacto</a>
        </nav>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const scrollLinks = document.querySelectorAll(".scroll-link");

    scrollLinks.forEach(link => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70, // Ajuste para header fijo
                    behavior: "smooth"
                });
            } else {
                // Si no está en la misma vista, redirecciona con el hash
                window.location.href = `{{ route('home') }}#${targetId}`;
            }
        });
    });
});

</script>
