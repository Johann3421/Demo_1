<div class="brands-section">
    <div class="marquee">
        <div class="marquee-content" id="marquee-container"></div>
    </div>
</div>

<script> 
    document.addEventListener("DOMContentLoaded", function () {
        const marqueeContainer = document.getElementById("marquee-container");

        // ✅ Cargar proveedores desde la API
        fetch('/api/proveedores')
            .then(response => response.json())
            .then(proveedores => {
                proveedores.forEach(proveedor => {
                    const brandItem = document.createElement("div");
                    brandItem.classList.add("brand-item");

                    const link = document.createElement("a");
                    link.href = proveedor.url;
                    link.target = "_blank";

                    const img = document.createElement("img");
                    img.src = proveedor.imagen_url; // ✅ Se usa la URL completa
                    img.alt = proveedor.alt_text;

                    link.appendChild(img);
                    brandItem.appendChild(link);
                    marqueeContainer.appendChild(brandItem);
                });

                iniciarMarquee(); // 🔥 Llamar la función de animación después de cargar los datos
            });
    });

    // ✅ Función para animación infinita sin cortes
    function iniciarMarquee() {
        const marqueeContainer = document.getElementById("marquee-container");
        const items = Array.from(marqueeContainer.children);

        // Duplicar imágenes para asegurar el loop infinito
        while (marqueeContainer.scrollWidth < window.innerWidth * 2) {
            items.forEach(item => {
                const clone = item.cloneNode(true);
                marqueeContainer.appendChild(clone);
            });
        }

        // Configuración de la animación CSS
        marqueeContainer.style.display = "flex";
        marqueeContainer.style.flexWrap = "nowrap";
        marqueeContainer.style.gap = "20px";
        marqueeContainer.style.willChange = "transform";
        marqueeContainer.style.animation = "marquee-scroll 50s linear infinite"; // 🔹 Velocidad reducida
 // Velocidad ajustada

        // Pausar animación al pasar el mouse
        marqueeContainer.addEventListener("mouseenter", () => {
            marqueeContainer.style.animationPlayState = "paused";
        });

        // Reanudar animación al salir el mouse
        marqueeContainer.addEventListener("mouseleave", () => {
            marqueeContainer.style.animationPlayState = "running";
        });
    }
</script>
