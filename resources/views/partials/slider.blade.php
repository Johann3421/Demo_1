<section id="slider" class="slider-section">
    <div class="slider-container">
        <div id="slider-carousel" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicadores -->
            <ol class="carousel-indicators">
                @foreach($sliders as $index => $slider)
                    <li data-bs-target="#slider-carousel" data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"></li>
                @endforeach
            </ol>

            <!-- Contenido del Slider -->
            <div class="carousel-inner">
                @foreach($sliders as $index => $slider)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <a href="{{ $slider->enlace }}" target="_blank" class="slider-link">
                            <div class="slider-image-content">
                                <img src="{{ asset($slider->imagen_url) }}" class="img-fluid slider-image" alt="{{ $slider->imagen_url }}">
                                <div class="slider-placeholder">SLIDER</div>
                            </div>
                        </a>
                    </div>
                @endforeach
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