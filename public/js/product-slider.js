document.addEventListener("DOMContentLoaded", function() {
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
                    currentPosition = Math.min(currentPosition, Math.max(totalProducts -
                        calculateVisibleItems(), 0));
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
