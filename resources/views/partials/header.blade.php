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

<section id="slider" class="slider-section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="slider-carousel" class="carousel slide" data-bs-ride="carousel">
                    <!-- Indicadores -->
                    <ol class="carousel-indicators">
                        <li data-bs-target="#slider-carousel" data-bs-slide-to="0" class="active"><i class="fas fa-circle"></i></li>
                        <li data-bs-target="#slider-carousel" data-bs-slide-to="1"><i class="fas fa-circle"></i></li>
                        <li data-bs-target="#slider-carousel" data-bs-slide-to="2"><i class="fas fa-circle"></i></li>
                        <li data-bs-target="#slider-carousel" data-bs-slide-to="3"><i class="fas fa-circle"></i></li>
                        <li data-bs-target="#slider-carousel" data-bs-slide-to="4"><i class="fas fa-circle"></i></li>
                    </ol>

                    <!-- Contenido del Slider -->
                    <div class="carousel-inner">
                        <!-- Slide 1 -->
                        <div class="carousel-item active">
                            <div class="row">
                                <!-- Texto (izquierda) -->
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h1><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h1>
                                    <h2>Oferta en Laptops - Precios Especiales</h2>
                                    <p>Consulta al Whatsapp 979375890 sobre los nuevos ingresos y promociones de las notebook, laptops, portatiles.</p>
                                    <a href="https://api.whatsapp.com/send?phone=51979375890&amp;text=Hola%2C%20he%20visto%20tu%20p%C3%A1gina%20web%20www.inkamatica.com%20quer%C3%ADa%20preguntarte%3A%20"
                                        class="btn btn-whatsapp">
                                        <i class="fab fa-whatsapp"></i> Consultar vía Whatsapp
                                    </a>
                                </div>
                                <!-- Imagen (derecha) -->
                                <div class="col-md-6">
                                    <img src="{{ asset('images/girl0.jpg') }}" class="img-fluid" alt="Laptops">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 2 -->
                        <div class="carousel-item">
                            <div class="row">
                                <!-- Texto (izquierda) -->
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h1><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h1>
                                    <h2>Gama de Laptops</h2>
                                    <p>Laptops, ultrabook, tabletas ... al alcance de todos.</p>
                                    <a href="index.php?buscar=Notebooks#ver" class="btn btn-primary">Buscar</a>
                                </div>
                                <!-- Imagen (derecha) -->
                                <div class="col-md-6">
                                    <img src="{{ asset('images/girl1.jpg') }}" class="img-fluid" alt="Gama de Laptops">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 3 -->
                        <div class="carousel-item">
                            <div class="row">
                                <!-- Texto (izquierda) -->
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h1><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h1>
                                    <h2>Sistemas de Impresión</h2>
                                    <p>Velocidad, economía, calidad, multifuncionales... pon color a tu vida.</p>
                                    <a href="index.php?buscar=Impresoras#ver" class="btn btn-primary">Buscar</a>
                                </div>
                                <!-- Imagen (derecha) -->
                                <div class="col-md-6">
                                    <img src="{{ asset('images/girl2.jpg') }}" class="img-fluid" alt="Sistemas de Impresión">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 4 -->
                        <div class="carousel-item">
                            <div class="row">
                                <!-- Texto (izquierda) -->
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h1><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h1>
                                    <h2>PC's</h2>
                                    <p>PC Gamer - PC armables - PC de marca - PC one - Mini PC y mucho mas.</p>
                                    <a href="index.php?buscar=Procesadores#ver" class="btn btn-primary">Buscar</a>
                                </div>
                                <!-- Imagen (derecha) -->
                                <div class="col-md-6">
                                    <img src="{{ asset('images/girl3.jpg') }}" class="img-fluid" alt="PC's">
                                </div>
                            </div>
                        </div>

                        <!-- Slide 5 -->
                        <div class="carousel-item">
                            <div class="row">
                                <!-- Texto (izquierda) -->
                                <div class="col-md-6 d-flex flex-column justify-content-center">
                                    <h1><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h1>
                                    <h2>Puntos de Venta (POS)</h2>
                                    <p>Colectores de Datos - Gavetas y Visor de Datos - Lectores de códigos de barras - Etiquetas - FotoCheck - Tickets - touch-screen.</p>
                                    <button type="button" class="btn btn-primary">Buscar</button>
                                </div>
                                <!-- Imagen (derecha) -->
                                <div class="col-md-6">
                                    <img src="{{ asset('images/girl4.jpg') }}" class="img-fluid" alt="Puntos de Venta">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Controles de navegación -->
                    <a class="carousel-control-prev" href="#slider-carousel" role="button" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </a>
                    <a class="carousel-control-next" href="#slider-carousel" role="button" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>