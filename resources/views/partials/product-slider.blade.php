<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const sliderTrack = document.querySelector(".sekai-slider-track");
    const productCards = document.querySelectorAll(".sekai-product-card");
    const prevBtn = document.querySelector(".sekai-prev");
    const nextBtn = document.querySelector(".sekai-next");

    let currentPosition = 0;
    const totalProducts = productCards.length;

    function calculateVisibleItems() {
        if (window.innerWidth >= 1200) return 4;
        if (window.innerWidth >= 768) return 2;
        return 1;
    }

    function updateSlider() {
        const visible = calculateVisibleItems();
        const cardWidth = productCards[0].offsetWidth + 20; // Ajuste para márgenes
        const maxPosition = Math.max(totalProducts - visible, 0); // Evita desbordes

        if (currentPosition > maxPosition) {
            currentPosition = maxPosition;
        } else if (currentPosition < 0) {
            currentPosition = 0;
        }

        sliderTrack.style.transform = `translateX(-${currentPosition * cardWidth}px)`;
        sliderTrack.style.transition = 'transform 0.7s ease-in-out';
    }

    function slideNext() {
        const visible = calculateVisibleItems();
        if (currentPosition + visible < totalProducts) {
            currentPosition += visible;
        } else {
            currentPosition = 0; // Reiniciar al inicio si se llega al final
        }
        updateSlider();
    }

    function slidePrev() {
        const visible = calculateVisibleItems();
        if (currentPosition - visible >= 0) {
            currentPosition -= visible;
        } else {
            currentPosition = Math.max(totalProducts - visible, 0); // Ir al final si se pasa
        }
        updateSlider();
    }

    // Event Listeners
    nextBtn.addEventListener("click", slideNext);
    prevBtn.addEventListener("click", slidePrev);

    // Auto-slide con pausa al interactuar
    let autoSlideInterval = setInterval(slideNext, 6000);

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(slideNext, 6000);
    }

    sliderTrack.addEventListener("mouseenter", () => clearInterval(autoSlideInterval));
    sliderTrack.addEventListener("mouseleave", resetAutoSlide);
    prevBtn.addEventListener("click", resetAutoSlide);
    nextBtn.addEventListener("click", resetAutoSlide);

    // Resetear posición en cambios de tamaño de pantalla
    window.addEventListener("resize", () => {
        currentPosition = 0;
        updateSlider();
    });

    updateSlider(); // Asegurar que el carrusel inicia correctamente
});

</script>
