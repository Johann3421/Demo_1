<header class="header shadow-sm bg-white py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('images/logo3.png') }}" alt="Logo" class="logo me-3"> <!-- Aumenté el margen derecho (me-3) -->
        </a>

        <!-- Menú de navegación -->
        <nav class="d-none d-md-flex align-items-center gap-4"> <!-- Añadí gap-4 para separar los enlaces -->
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>
            <a href="{{ route('cart.view') }}" class="nav-link">
                Carrito <i class="fas fa-shopping-cart"></i>
            </a>
            <a href="{{ route('contact') }}" class="btn btn-primary ms-3">Contacto</a>
        </nav>

        <!-- Menú Responsive -->
        <button class="navbar-toggler d-md-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Menú Responsive (móvil) -->
    <div class="collapse navbar-collapse bg-white p-3" id="navbarNav">
        <nav class="d-flex flex-column gap-2"> <!-- Añadí gap-2 para separar los enlaces en móvil -->
            <a href="{{ route('home') }}" class="nav-link">Inicio</a>
            <a href="{{ route('products') }}" class="nav-link">Productos</a>
            <a href="{{ route('cart.view') }}" class="nav-link">Carrito</a>
            <a href="{{ route('contact') }}" class="btn btn-primary mt-2">Contacto</a>
        </nav>
    </div>
</header>