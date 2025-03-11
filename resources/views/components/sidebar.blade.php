<link rel="stylesheet" href="{{ asset('css/custom.css') }}">

<div class="sidebar-container">
    <form id="filter-form">
        <!-- Filtro de Precio -->
        <div>
            <h2>FILTER BY PRICE</h2>
            <div class="price-container">
                <span id="price-label">$0</span>
                <span>$5000</span>
            </div>
            <input type="range" id="price" name="max_price" min="0" max="5000" step="1" value="5000" class="price-range w-full mt-2">
        </div>

        <!-- Filtro de Stock -->
        <div>
            <h2>STOCK STATUS</h2>
            <div class="checkbox-group">
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="on-sale" name="stock" value="on-sale" class="form-checkbox">
                    <label for="on-sale">On sale</label>
                </div>
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="in-stock" name="stock" value="in-stock" class="form-checkbox">
                    <label for="in-stock">In stock</label>
                </div>
            </div>
        </div>

        <!-- Filtro de Categoría -->
        <div class="mb-6"> 
            <h2>CATEGORY</h2>
            <select name="categoria_id" class="category-select">
                <option value="">All Categories</option>
                <option value="1">Laptops</option>
                <option value="2">Graphics Cards</option>
                <option value="3">Monitors</option>
            </select>
        </div>

        <!-- Botón de Filtrar -->
        <button type="submit" class="filter-button mt-6">FILTRAR</button> 
    </form>

    <!-- Sección Top de Ventas -->
    <div class="top-sales mt-8">
        <h2 class="text-lg font-bold text-gray-800 mb-4">TOP DE VENTAS</h2>
        <ul id="top-sales-list" class="space-y-4">
            @foreach($topVentas as $producto)
                <li class="flex items-center space-x-4 border-b pb-3">
                    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="flex items-center space-x-4">
                        <img src="{{ asset('images/' . $producto->imagen_url) }}" class="top-sales-img">
                        <div class="top-sales-info">
                            <p class="top-sales-name">{{ $producto->nombre }}</p>
                            <p class="top-sales-price">${{ number_format($producto->precio_dolares, 2) }}</p>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<!-- Sección donde se mostrarán los productos filtrados -->
<div id="filtered-products" class="products-container">
    <!-- Aquí se actualizarán los productos dinámicamente -->
</div>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterForm = document.getElementById("filter-form");
    const priceSlider = document.getElementById("price");
    const priceLabel = document.getElementById("price-label");
    const checkboxes = document.querySelectorAll("#filter-form input[type='checkbox']");
    const productsContainer = document.querySelector(".product-grid-specific");

    // Función para actualizar el valor de la etiqueta de precio dinámicamente
    function updatePriceLabel() {
        let value = priceSlider.value;
        priceLabel.textContent = `$${value}`;

        // Calcular el porcentaje de la barra de progreso
        let percentage = (value / 5000) * 100;
        priceSlider.style.background = `linear-gradient(to right, #3b82f6 ${percentage}%, #ddd ${percentage}%)`;
    }

    // Detectar cambios en el slider y actualizar el precio dinámicamente
    priceSlider.addEventListener("input", updatePriceLabel);

    // Función para enviar los filtros y actualizar los productos
    function applyFilters() {
        const formData = new FormData(filterForm);

        // Agregar los checkboxes seleccionados al formData
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                formData.append(checkbox.name, checkbox.value);
            }
        });

        const queryString = new URLSearchParams(formData).toString();

        // Mostrar un mensaje de "Cargando..."
        productsContainer.innerHTML = "<p class='text-center text-gray-500'>Cargando productos...</p>";

        // Hacer la solicitud AJAX para filtrar productos
        fetch(`/productos/filter?${queryString}`)
            .then(response => response.text()) // Recibir respuesta como HTML
            .then(html => {
                productsContainer.innerHTML = html; // Reemplazar productos filtrados
                updatePriceLabel(); // Mantener la actualización del precio
            })
            .catch(error => console.error("Error al filtrar los productos:", error));
    }

    // Detectar cambios en los checkboxes y aplicar los filtros automáticamente
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener("change", applyFilters);
    });

    // Detectar envío del formulario y aplicar los filtros
    filterForm.addEventListener("submit", function(event) {
        event.preventDefault(); // Evita recargar la página
        applyFilters();
    });

    // Llamar a la función al cargar la página para establecer el color inicial del slider
    updatePriceLabel();
});
</script>


