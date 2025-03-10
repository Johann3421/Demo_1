<section id="slider" class="slider-section">
    <div class="slider-container">
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
                    <div class="slider-content-wrapper">
<div class="slider-text-content">
    <h2><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h2>
    <h3>Oferta en Laptops - Precios Especiales</h3>
    <p>Consulta al Whatsapp +51 933 573 985 sobre los nuevos ingresos y promociones de las notebook, laptops, portatiles.</p>
    <a id="whatsapp-link" href="#" class="btn btn-whatsapp">
        <i class="fab fa-whatsapp"></i> Consultar vía Whatsapp
    </a>
</div>
                        <div class="slider-image-content">
                            <img src="{{ asset('images/girl0.jpg') }}" class="img-fluid" alt="Laptops">
                        </div>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="slider-content-wrapper">
                        <div class="slider-text-content">
                            <h2><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h2>
                            <h3>Gama de Laptops</h3>
                            <p>Laptops, ultrabook, tabletas ... al alcance de todos.</p>
                            <a href="index.php?buscar=Notebooks#ver" class="btn btn-primary">Buscar</a>
                        </div>
                        <div class="slider-image-content">
                            <img src="{{ asset('images/girl1.jpg') }}" class="img-fluid" alt="Gama de Laptops">
                        </div>
                    </div>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <div class="slider-content-wrapper">
                        <div class="slider-text-content">
                            <h2><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h2>
                            <h3>Sistemas de Impresión</h3>
                            <p>Velocidad, economía, calidad, multifuncionales... pon color a tu vida.</p>
                            <a href="index.php?buscar=Impresoras#ver" class="btn btn-primary">Buscar</a>
                        </div>
                        <div class="slider-image-content">
                            <img src="{{ asset('images/girl2.jpg') }}" class="img-fluid" alt="Sistemas de Impresión">
                        </div>
                    </div>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <div class="slider-content-wrapper">
                        <div class="slider-text-content">
                            <h2><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h2>
                            <h3>PC's</h3>
                            <p>PC Gamer - PC armables - PC de marca - PC one - Mini PC y mucho mas.</p>
                            <a href="index.php?buscar=Procesadores#ver" class="btn btn-primary">Buscar</a>
                        </div>
                        <div class="slider-image-content">
                            <img src="{{ asset('images/girl3.jpg') }}" class="img-fluid" alt="PC's">
                        </div>
                    </div>
                </div>

                <!-- Slide 5 -->
                <div class="carousel-item">
                    <div class="slider-content-wrapper">
                        <div class="slider-text-content">
                            <h2><span class="text-sekai">SEKAI</span><span class="text-tech">TECH</span></h2>
                            <h3>Puntos de Venta (POS)</h3>
                            <p>Colectores de Datos - Gavetas y Visor de Datos - Lectores de códigos de barras - Etiquetas - FotoCheck - Tickets - touch-screen.</p>
                            <button type="button" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="slider-image-content">
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
</section>

<script>
    // Mensaje personalizado
    const mensaje = "Hola, vi tu página web www.sekaitech.com.pe y quiero consultar sobre las ofertas de laptops.";

    // Codificar el mensaje
    const mensajeCodificado = encodeURIComponent(mensaje);

    // Número de teléfono
    const telefono = "51933573985";

    // Generar el enlace de WhatsApp
    const whatsappLink = `https://api.whatsapp.com/send?phone=${telefono}&text=${mensajeCodificado}`;

    // Asignar el enlace al botón
    document.getElementById('whatsapp-link').href = whatsappLink;
</script>