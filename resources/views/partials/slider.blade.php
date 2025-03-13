<section id="slider" class="slider-section">
    <div class="slider-container">
        <div id="slider-carousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <li data-bs-target="#slider-carousel" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#slider-carousel" data-bs-slide-to="1"></li>
                <li data-bs-target="#slider-carousel" data-bs-slide-to="2"></li>
                <li data-bs-target="#slider-carousel" data-bs-slide-to="3"></li>
            </ol>

            <!-- Contenido del Slider -->
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <a href="https://www.tu-link-aqui.com" target="_blank" class="slider-link">
                        <div class="slider-image-content">
                            <img src="{{ asset('images/banner.png') }}" class="img-fluid slider-image" alt="Laptops">
                            <div class="slider-placeholder">SLIDER</div>
                        </div>
                    </a>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <a href="https://www.tu-link-aqui.com" target="_blank" class="slider-link">
                        <div class="slider-image-content">
                            <img src="{{ asset('images/AUDIFONO.png') }}" class="img-fluid slider-image" alt="Gama de Laptops">
                            <div class="slider-placeholder">SLIDER</div>
                        </div>
                    </a>
                </div>

                <!-- Slide 3 -->
                <div class="carousel-item">
                    <a href="https://www.tu-link-aqui.com" target="_blank" class="slider-link">
                        <div class="slider-image-content">
                            <img src="{{ asset('images/banner.png') }}" class="img-fluid slider-image" alt="Sistemas de Impresión">
                            <div class="slider-placeholder">SLIDER</div>
                        </div>
                    </a>
                </div>

                <!-- Slide 4 -->
                <div class="carousel-item">
                    <a href="https://www.tu-link-aqui.com" target="_blank" class="slider-link">
                        <div class="slider-image-content">
                            <img src="{{ asset('images/banner.png') }}" class="img-fluid slider-image" alt="PC's">
                            <div class="slider-placeholder">SLIDER</div>
                        </div>
                    </a>
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
