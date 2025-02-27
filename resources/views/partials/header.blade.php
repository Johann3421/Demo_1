<header class="bg-white text-black py-3">
<img src="{{ asset('images/logo1.ico') }}" alt="Logo" class="logo">
    <div class="container d-flex justify-content-between align-items-center">
    
        <h1 class="h3">Mi Tienda</h1>
        <nav>
            <a href="{{ route('home') }}" class="text-black mx-2">Inicio</a>
            <a href="{{ route('products') }}" class="text-black mx-2">Productos</a>
            <a href="{{ route('cart.view') }}" class="text-black mx-2">Carrito</a>
            <a href="#" class="text-white mx-2">Contacto</a>
        </nav>
    </div>
</header>