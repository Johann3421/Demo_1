<header class="header shadow-sm bg-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('images/LOGO-SEKAITECH.png') }}" alt="Logo" class="logo me-3">
        </a>

        <!-- Menú de navegación (Desktop) -->
        <nav class="d-none d-md-flex align-items-center gap-4">
            @include('partials.search')
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>
            <a href="{{ route('cart.view') }}" class="nav-link">
                <i class="fas fa-shopping-cart"></i> Carrito
            </a>
            <a href="{{ route('contact') }}" class="btn btn-primary ms-3">Contacto</a>
        </nav>

        <!-- Botón de menú para móviles -->
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"><i class="fas fa-bars"></i></span>
        </button>
    </div>

    <!-- Menú Responsive (móvil) -->
    <div class="collapse navbar-collapse bg-white p-3" id="navbarNav">
        <nav class="d-flex flex-column gap-2">
            @include('partials.search')
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>
            <a href="{{ route('cart.view') }}" class="nav-link">
                <i class="fas fa-shopping-cart"></i> Carrito
            </a>
            <a href="{{ route('contact') }}" class="btn btn-primary mt-2">Contacto</a>
        </nav>
    </div>
</header>