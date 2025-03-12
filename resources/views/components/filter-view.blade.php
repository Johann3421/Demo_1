<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<div class="flex justify-between items-center mb-4">
    <!-- Breadcrumb dinámico -->
    <div>
        <a href="{{ route('home') }}" class="text-gray-500">Inicio</a> /
        <a href="{{ route('products') }}" class="text-gray-500">Productos</a> /
        <span class="text-gray-800" id="category-name">{{ $categoriaActual }}</span>
    </div>

    <!-- Controles de visualización -->
    <div class="flex items-center space-x-4">
        <span>Show :</span>
        <a href="#" class="text-gray-500 items-per-page" data-count="9">9</a>
        <a href="#" class="text-gray-500 items-per-page" data-count="12">12</a>
        <a href="#" class="text-gray-500 items-per-page" data-count="18">18</a>
        <a href="#" class="text-gray-500 items-per-page" data-count="24">24</a>

        <!-- Iconos para cambiar la vista -->
        <i class="fas fa-th-large ml-4 view-mode" data-view="grid-3"></i>
        <i class="fas fa-th view-mode" data-view="grid-4"></i>
        <i class="fas fa-list view-mode" data-view="list"></i>

        <!-- Botón de filtros -->
        <a href="#" class="text-gray-500 ml-2 filter-toggle">Filters</a>
    </div>
</div>

<!-- Submenú de Filtros (oculto inicialmente) -->
<div class="hidden bg-gray-100 p-4 rounded-md" id="filters-menu">
    <h3 class="font-bold text-lg">Filtros Avanzados</h3>
    <form id="advanced-filters">
        <label class="block">
            <span class="text-gray-700">Ordenar por:</span>
            <select name="sort_by" class="w-full p-2 border rounded">
                <option value="popularity">Popularidad</option>
                <option value="rating">Mejor Calificación</option>
                <option value="date">Más reciente</option>
                <option value="price">Menor precio</option>
                <option value="price-desc">Mayor precio</option>
            </select>
        </label>

        <label class="block mt-3">
            <span class="text-gray-700">Rango de Precio:</span>
            <input type="range" name="price_range" min="0" max="5000" step="100" class="w-full mt-2">
        </label>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-3">Aplicar Filtros</button>
    </form>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const filterToggle = document.querySelector(".filter-toggle");
    const filtersMenu = document.getElementById("filters-menu");
    const itemsPerPageLinks = document.querySelectorAll(".items-per-page");
    const viewModeIcons = document.querySelectorAll(".view-mode");
    const productGrid = document.querySelector(".product-grid-specific");

    // Mostrar/Ocultar menú de filtros con animación
    filterToggle.addEventListener("click", function(event) {
        event.preventDefault();
        filtersMenu.classList.toggle("active");
    });

    // Cambiar cantidad de productos por página
    itemsPerPageLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            const count = this.getAttribute("data-count");

            // Enviar AJAX para actualizar productos
            fetch(`/productos/filter?per_page=${count}`)
                .then(response => response.text())
                .then(html => {
                    productGrid.innerHTML = html;
                })
                .catch(error => console.error("Error al cambiar la cantidad de productos:", error));
        });
    });

    // Cambiar el modo de visualización (grid 3x3, grid 4x4, lista)
    viewModeIcons.forEach(icon => {
        icon.addEventListener("click", function() {
            const view = this.getAttribute("data-view");
            
            productGrid.classList.remove("grid-cols-3", "grid-cols-4", "list-view");
            
            if (view === "grid-3") {
                productGrid.classList.add("grid-cols-3");
            } else if (view === "grid-4") {
                productGrid.classList.add("grid-cols-4");
            } else {
                productGrid.classList.add("list-view");
            }
        });
    });
});
</script>

