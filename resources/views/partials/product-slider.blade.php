<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="text-center mt-5">
    <h1 class="section-title">NUESTROS PRODUCTOS</h1>
</div>

<div id="product-slider-container" class="product-slider-container mt-4">
    <div class="product-slider-inner">
        @foreach($productos as $producto)
            <div class="product-slider-item">
                <div class="product-card">
                    <a href="{{ route('product.show', $producto->id) }}" class="text-decoration-none">
                        <img src="{{ asset('images/' . $producto->imagen_url) }}" class="product-image" alt="{{ $producto->nombre }}">
                        <h5 class="product-name">{{ $producto->nombre }}</h5>
                        <p class="product-price">S/. {{ number_format($producto->precio_soles, 2) }}</p>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <button class="product-slider-prev" type="button"></button>
    <button class="product-slider-next" type="button"></button>
</div>


<script> 
    document.addEventListener("DOMContentLoaded", function () {
    const slider = document.querySelector(".product-slider-inner");
    const items = document.querySelectorAll(".product-slider-item");
    const prevBtn = document.querySelector(".product-slider-prev");
    const nextBtn = document.querySelector(".product-slider-next");

    let index = 0;
    const totalItems = items.length;

    function getVisibleItems() {
        if (window.innerWidth >= 992) {
            return 4; // 4 productos en PC
        } else if (window.innerWidth >= 768) {
            return 2; // 2 productos en tablets
        } else {
            return 1; // 1 producto en móviles
        }
    }

    function updateSliderPosition() {
        const itemWidth = items[0].offsetWidth + 10; // Ancho del producto + margen
        slider.style.transform = `translateX(-${index * itemWidth}px)`;
    }

    function nextSlide() {
        const visibleItems = getVisibleItems();
        if (index < totalItems - visibleItems) {
            index++;
        } else {
            index = 0; // Reinicia cuando llega al final
        }
        updateSliderPosition();
    }

    function prevSlide() {
        if (index > 0) {
            index--;
        } else {
            index = totalItems - getVisibleItems(); // Vuelve al final si está en el inicio
        }
        updateSliderPosition();
    }

    prevBtn.addEventListener("click", prevSlide);
    nextBtn.addEventListener("click", nextSlide);

    // Slider automático cada 3 segundos
    let autoSlide = setInterval(nextSlide, 3000);

    // Detener el slider cuando el usuario interactúa con los botones
    prevBtn.addEventListener("mouseenter", () => clearInterval(autoSlide));
    nextBtn.addEventListener("mouseenter", () => clearInterval(autoSlide));
    prevBtn.addEventListener("mouseleave", () => autoSlide = setInterval(nextSlide, 3000));
    nextBtn.addEventListener("mouseleave", () => autoSlide = setInterval(nextSlide, 3000));

    // Ajustar el slider cuando la ventana cambie de tamaño
    window.addEventListener("resize", updateSliderPosition);
});
</script>
