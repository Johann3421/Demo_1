<div class="brands-section">
    <div class="marquee">
        <div class="marquee-content" id="marquee-container"></div>
    </div>
</div>

<script> 
    document.addEventListener("DOMContentLoaded", function () {
    const marqueeContainer = document.getElementById("marquee-container");

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
                img.src = proveedor.imagen_url;
                img.alt = proveedor.alt_text;

                link.appendChild(img);
                brandItem.appendChild(link);
                marqueeContainer.appendChild(brandItem);
            });

            iniciarMarquee();
        });
});

function iniciarMarquee() {
    const marqueeContainer = document.getElementById("marquee-container");
    const items = Array.from(marqueeContainer.children);

    while (marqueeContainer.scrollWidth < window.innerWidth * 2) {
        items.forEach(item => {
            const clone = item.cloneNode(true);
            marqueeContainer.appendChild(clone);
        });
    }

    marqueeContainer.style.animation = "marquee-scroll 50s linear infinite";

    marqueeContainer.addEventListener("mouseenter", () => {
        marqueeContainer.style.animationPlayState = "paused";
    });

    marqueeContainer.addEventListener("mouseleave", () => {
        marqueeContainer.style.animationPlayState = "running";
    });
}

</script>
