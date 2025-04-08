document.addEventListener('DOMContentLoaded', function() {
    const carrusel = document.querySelector('.sekai-mobile-carrusel');

    if (carrusel) {
        // Crear contenedor de flechas
        const flechaIzq = document.createElement('button');
        flechaIzq.className = 'sekai-carrusel-flecha sekai-carrusel-flecha-izq';
        flechaIzq.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M15 18L9 12L15 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

        const flechaDer = document.createElement('button');
        flechaDer.className = 'sekai-carrusel-flecha sekai-carrusel-flecha-der';
        flechaDer.innerHTML = `<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 18L15 12L9 6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>`;

        carrusel.parentNode.insertBefore(flechaIzq, carrusel);
        carrusel.parentNode.insertBefore(flechaDer, carrusel.nextSibling);

        // Crear indicadores
        const slides = carrusel.querySelectorAll('.sekai-mobile-categoria-slide');
        const indicadoresContainer = document.createElement('div');
        indicadoresContainer.className = 'sekai-carrusel-indicadores';

        slides.forEach((_, index) => {
            const indicador = document.createElement('div');
            indicador.className = 'sekai-carrusel-indicador' + (index === 0 ? ' active' : '');
            indicadoresContainer.appendChild(indicador);
        });

        carrusel.parentNode.insertBefore(indicadoresContainer, carrusel.nextSibling);

        // Configuración del carrusel
        let currentIndex = 0;
        const slideWidth = slides[0].offsetWidth;
        const indicadores = document.querySelectorAll('.sekai-carrusel-indicador');

        // Actualizar posición
        const updatePosition = () => {
            carrusel.scrollTo({
                left: currentIndex * slideWidth,
                behavior: 'smooth'
            });
            updateIndicators();
        };

        // Actualizar indicadores
        const updateIndicators = () => {
            indicadores.forEach((ind, i) => {
                ind.classList.toggle('active', i === currentIndex);
            });

            // Mostrar/ocultar flechas según posición
            flechaIzq.style.display = currentIndex === 0 ? 'none' : 'flex';
            flechaDer.style.display = currentIndex === slides.length - 1 ? 'none' : 'flex';
        };

        // Eventos de flechas
        flechaIzq.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updatePosition();
            }
        });

        flechaDer.addEventListener('click', () => {
            if (currentIndex < slides.length - 1) {
                currentIndex++;
                updatePosition();
            }
        });

        // Eventos de indicadores
        indicadores.forEach((indicador, index) => {
            indicador.addEventListener('click', () => {
                currentIndex = index;
                updatePosition();
            });
        });

        // Evento de scroll para detectar cambios
        carrusel.addEventListener('scroll', () => {
            const newIndex = Math.round(carrusel.scrollLeft / slideWidth);
            if (newIndex !== currentIndex) {
                currentIndex = newIndex;
                updateIndicators();
            }
        });

        // Inicializar
        updateIndicators();

        // Ocultar flechas en desktop
        const mediaQuery = window.matchMedia('(min-width: 769px)');
        function handleTabletChange(e) {
            if (e.matches) {
                flechaIzq.style.display = 'none';
                flechaDer.style.display = 'none';
            } else {
                updateIndicators();
            }
        }
        mediaQuery.addListener(handleTabletChange);
        handleTabletChange(mediaQuery);
    }
});
