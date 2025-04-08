<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('css/product-slider.css') }}">
<div class="text-center mt-5">
    <h1 class="sekai-main-heading">Explora Nuestro Catálogo</h1>
    <p class="sekai-subheading">Tecnología de última generación a tu alcance</p>
</div>

<div id="sekai-tech-slider" class="sekai-slider-wrapper mt-4">
    <div class="sekai-slider-track">
        @foreach ($productos as $producto)
            <div class="sekai-product-card">
                <div class="sekai-product-inner">
                    <a href="{{ route('product.show', ['id' => $producto->id, 'slug' => $producto->slug]) }}"
                        class="sekai-product-link">
                        <div class="sekai-image-container">
                            <img src="{{ asset('images/' . $producto->imagen_url) }}" class="sekai-product-image"
                                alt="{{ $producto->nombre }}" loading="lazy">
                            <div class="sekai-image-overlay"></div>
                        </div>
                        <div class="sekai-product-info">
                            <h5 class="sekai-product-title">{{ $producto->nombre }}</h5>
                            <div class="sekai-price-container">
                                <span class="sekai-currency">S/</span>
                                <span class="sekai-product-price">{{ number_format($producto->precio_soles, 2) }}</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <button class="sekai-nav-button sekai-prev" type="button">
        <span class="sekai-nav-arrow">‹</span>
    </button>
    <button class="sekai-nav-button sekai-next" type="button">
        <span class="sekai-nav-arrow">›</span>
    </button>
</div>
<script src="{{ asset('js/product-slider.js') }}"></script>
