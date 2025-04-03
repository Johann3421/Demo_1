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
    const wrapper = document.querySelector(".sekai-slider-wrapper");

    let currentPosition = 0;
    const totalProducts = productCards.length;
    let cardWidth = 0;
    let gapSize = 0;
    let wrapperPadding = 0;

    // Función para calcular elementos visibles
    function calculateVisibleItems() {
        const wrapperWidth = wrapper.offsetWidth;
        if (wrapperWidth >= 1200) return 4;
        if (wrapperWidth >= 768) return 2;
        return 1;
    }

    // Función para actualizar dimensiones con precisión
    function updateDimensions() {
        if (productCards.length > 0) {
            const cardStyle = window.getComputedStyle(productCards[0]);
            const trackStyle = window.getComputedStyle(sliderTrack);
            const wrapperStyle = window.getComputedStyle(wrapper);

            cardWidth = productCards[0].getBoundingClientRect().width;
            gapSize = parseFloat(trackStyle.gap);
            wrapperPadding = parseFloat(wrapperStyle.paddingLeft);
        }
    }

    // Función para ajuste perfecto del slider
    function updateSlider() {
        updateDimensions();
        const visible = calculateVisibleItems();
        const maxPosition = Math.max(totalProducts - visible, 0);

        currentPosition = Math.min(currentPosition, maxPosition);
        currentPosition = Math.max(currentPosition, 0);

        // Cálculo preciso incluyendo padding del wrapper
        const offset = currentPosition * (cardWidth + gapSize) - wrapperPadding;
        sliderTrack.style.transform = `translateX(-${offset}px)`;
        sliderTrack.style.transition = 'transform 0.7s cubic-bezier(0.16, 1, 0.3, 1)';
    }

    // Función para avanzar con precisión
    function slideNext() {
        const visible = calculateVisibleItems();
        if (currentPosition + visible < totalProducts) {
            currentPosition += visible;
        } else {
            // Ajuste especial para el último grupo
            currentPosition = 0;
            // Temporizador para sincronizar el reinicio
            setTimeout(updateSlider, 50);
        }
        updateSlider();
    }

    // Función para retroceder con precisión
    function slidePrev() {
        const visible = calculateVisibleItems();
        if (currentPosition - visible >= 0) {
            currentPosition -= visible;
        } else {
            // Ajuste especial para el primer grupo
            currentPosition = Math.max(totalProducts - visible, 0);
            // Temporizador para sincronizar el ajuste
            setTimeout(updateSlider, 50);
        }
        updateSlider();
    }

    // Event Listeners mejorados
    nextBtn.addEventListener("click", () => {
        slideNext();
        // Pequeño ajuste adicional después de la animación
        setTimeout(updateDimensions, 700);
    });

    prevBtn.addEventListener("click", () => {
        slidePrev();
        // Pequeño ajuste adicional después de la animación
        setTimeout(updateDimensions, 700);
    });

    // Auto-desplazamiento optimizado
    let autoSlideInterval = setInterval(slideNext, 6000);

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        autoSlideInterval = setInterval(slideNext, 6000);
    }

    // Observador de cambios de tamaño mejorado
    const resizeObserver = new ResizeObserver(entries => {
        for (let entry of entries) {
            if (entry.contentBoxSize) {
                // Ajuste fino después del resize
                requestAnimationFrame(() => {
                    currentPosition = Math.min(currentPosition, Math.max(totalProducts - calculateVisibleItems(), 0));
                    updateSlider();
                });
            }
        }
    });

    resizeObserver.observe(wrapper);
    resizeObserver.observe(document.body);

    // Inicialización con doble verificación
    setTimeout(() => {
        updateDimensions();
        updateSlider();
        // Segundo ajuste para garantizar precisión
        requestAnimationFrame(updateSlider);
    }, 100);

    // Ajuste periódico para mantener precisión
    setInterval(updateDimensions, 3000);
});
</script>
<style>
    /* Estilo para el título principal */
.sekai-main-heading {
    font-family: 'Montserrat', sans-serif;
    font-weight: 800;
    font-size: 3rem;
    line-height: 1.15;
    color: #1a202c;
    margin-bottom: 1.5rem;
    position: relative;
    display: inline-block;
    background: linear-gradient(90deg, #4f46e5, #10b981);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    text-shadow: 0 2px 10px rgba(79, 70, 229, 0.15);
    letter-spacing: -0.5px;
    padding-bottom: 1rem;
}

.sekai-main-heading::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 120px;
    height: 4px;
    background: linear-gradient(90deg, #4f46e5, #10b981);
    border-radius: 4px;
    box-shadow: 0 2px 8px rgba(79, 70, 229, 0.3);
}

/* Estilo para el subtítulo */
.sekai-subheading {
    font-family: 'Inter', sans-serif;
    font-weight: 400;
    font-size: 1.25rem;
    color: #4a5568;
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
    position: relative;
    padding: 0 1rem;
}

.sekai-subheading::before,
.sekai-subheading::after {
    content: '✦';
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #4f46e5;
    font-size: 1rem;
    opacity: 0.7;
}

.sekai-subheading::before {
    left: -10px;
}

.sekai-subheading::after {
    right: -10px;
}

/* Efectos hover */
.sekai-main-heading:hover {
    animation: textGlow 1.5s ease-in-out infinite alternate;
}

.sekai-subheading:hover {
    color: #2d3748;
    transition: color 0.3s ease;
}

/* Animaciones */
@keyframes textGlow {
    from {
        text-shadow: 0 2px 10px rgba(79, 70, 229, 0.15);
    }
    to {
        text-shadow: 0 2px 20px rgba(79, 70, 229, 0.3);
    }
}

/* Transición de entrada */
.sekai-main-heading {
    animation: fadeInUp 0.8s cubic-bezier(0.22, 0.61, 0.36, 1) forwards;
}

.sekai-subheading {
    animation: fadeInUp 0.8s cubic-bezier(0.22, 0.61, 0.36, 1) 0.2s forwards;
    opacity: 0;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Versión responsive */
@media (max-width: 1024px) {
    .sekai-main-heading {
        font-size: 2.5rem;
    }

    .sekai-subheading {
        font-size: 1.1rem;
    }
}

@media (max-width: 768px) {
    .sekai-main-heading {
        font-size: 2rem;
        padding-bottom: 0.8rem;
    }

    .sekai-main-heading::after {
        width: 80px;
        height: 3px;
    }

    .sekai-subheading {
        font-size: 1rem;
        padding: 0 0.5rem;
    }

    .sekai-subheading::before,
    .sekai-subheading::after {
        font-size: 0.8rem;
    }
}

@media (max-width: 480px) {
    .sekai-main-heading {
        font-size: 1.8rem;
    }

    .sekai-subheading {
        font-size: 0.9rem;
    }

    .sekai-subheading::before,
    .sekai-subheading::after {
        display: none;
    }
}
</style>
