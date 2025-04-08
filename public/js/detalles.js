// ✅ Scroll automático al cuadro del producto si hay un parámetro en la URL
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has("producto")) {
        document.getElementById("product-detail").scrollIntoView({
            behavior: "smooth"
        });
    }
});

// ✅ Cambio de imagen principal al hacer clic en una miniatura
document.querySelectorAll('.thumb').forEach(thumb => {
    thumb.addEventListener('click', function() {
        document.querySelector('.product-main-image img').src = this.src;
    });
});

// ✅ Funcionalidad de Likes
document.querySelector('.like-button').addEventListener('click', function() {
    const productId = this.dataset.id;
    const likeCountElement = this.querySelector('.like-count');
    let likeCount = parseInt(likeCountElement.textContent);

    // Simular la acción de dar like (puedes implementar una llamada AJAX aquí)
    likeCount += 1;
    likeCountElement.textContent = likeCount;

    // Deshabilitar el botón después de dar like
    this.disabled = true;
    this.classList.add('disabled');
});
document.querySelectorAll('.detail-row span').forEach(span => {
    span.addEventListener('mouseover', function() {
        this.setAttribute('title', this.textContent);
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const mainImg = document.querySelector('.main-img');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const modal = document.querySelector('.image-modal');
    const modalImg = document.querySelector('.modal-content');
    const closeModal = document.querySelector('.close-modal');

    // 1. Modal pantalla completa
    mainImg.addEventListener('click', () => {
        modal.style.display = 'flex';
        modalImg.src = mainImg.src;
    });

    closeModal.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    modal.addEventListener('click', (e) => {
        if (e.target === modal) modal.style.display = 'none';
    });

    // 2. Zoom con lupa (fluido)
    const lens = document.createElement('div');
    lens.className = 'zoom-lens';
    document.body.appendChild(lens); // Se añade al body para evitar overflow

    mainImg.addEventListener('mousemove', (e) => {
        const imgRect = mainImg.getBoundingClientRect();
        const scale = 2; // Nivel de zoom

        // Posición del mouse relativa a la imagen
        let x = e.clientX - imgRect.left;
        let y = e.clientY - imgRect.top;

        // Ajustar para que la lupa no salga de la imagen
        x = Math.max(75, Math.min(x, imgRect.width - 75));
        y = Math.max(75, Math.min(y, imgRect.height - 75));

        // Mover la lupa
        lens.style.left = `${e.clientX}px`;
        lens.style.top = `${e.clientY}px`;
        lens.style.opacity = '1';

        // Efecto de zoom (simulado)
        lens.style.backgroundImage = `url(${mainImg.src})`;
        lens.style.backgroundSize = `${imgRect.width * scale}px ${imgRect.height * scale}px`;
        lens.style.backgroundPosition = `-${(x - 75) * scale}px -${(y - 75) * scale}px`;
    });

    mainImg.addEventListener('mouseleave', () => {
        lens.style.opacity = '0';
    });

    // 3. Miniaturas (cambiar imagen principal)
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', () => {
            mainImg.src = thumb.src;
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los botones de Like
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Alternar la clase 'liked' para cambiar el estilo
            this.classList.toggle('liked');

            // Simular un incremento en el contador de likes (puedes ajustar esto según tu lógica)
            const likeCount = this.querySelector('.like-count');
            let count = parseInt(likeCount.textContent);
            likeCount.textContent = this.classList.contains('liked') ? count + 1 : count -
                1;
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Seleccionar todos los botones de like
    const likeButtons = document.querySelectorAll('.like-button');

    likeButtons.forEach(button => {
        const productId = button.dataset.id;
        const likeCountSpan = button.querySelector('.like-count');

        // Clave única para almacenar en localStorage
        const storageKey = `product_like_${productId}`;

        // Obtener likes guardados o inicializar a 0
        let likes = parseInt(localStorage.getItem(storageKey)) || 0;
        likeCountSpan.textContent = likes;

        // Verificar si el usuario ya dio like (para cambiar el estilo)
        const userLikeKey = `user_like_${productId}`;
        const userLiked = localStorage.getItem(userLikeKey) === 'true';

        if (userLiked) {
            button.classList.add('liked');
            button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
        }

        // Evento click
        button.addEventListener('click', function() {
            const alreadyLiked = localStorage.getItem(userLikeKey) === 'true';

            if (alreadyLiked) {
                // Quitar like
                likes = Math.max(0, likes - 1);
                localStorage.setItem(userLikeKey, 'false');
                button.classList.remove('liked');
                button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
            } else {
                // Añadir like
                likes += 1;
                localStorage.setItem(userLikeKey, 'true');
                button.classList.add('liked');
                button.querySelector('i').classList.replace('fa-thumbs-up', 'fa-thumbs-up');
            }

            // Actualizar contador y almacenamiento
            likeCountSpan.textContent = likes;
            localStorage.setItem(storageKey, likes.toString());

            // Efecto visual
            button.classList.add('animate-like');
            setTimeout(() => {
                button.classList.remove('animate-like');
            }, 300);
        });
    });
});
