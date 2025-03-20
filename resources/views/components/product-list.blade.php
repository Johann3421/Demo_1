<!-- Contenedor de selectores (cantidad y vista) -->
<div class="selectors-container">
    <!-- Selector de cantidad de productos por página -->
    <div class="per-page-selector">
        <label for="per_page">Productos por página:</label>
        <select id="per_page" name="per_page" onchange="updatePerPage(this.value)">
            <option value="6" {{ request('per_page') == 6 ? 'selected' : '' }}>6</option>
            <option value="9" {{ request('per_page') == 9 ? 'selected' : '' }}>9</option>
            <option value="12" {{ request('per_page') == 12 ? 'selected' : '' }}>12</option>
            <option value="16" {{ request('per_page') == 16 ? 'selected' : '' }}>16</option>
        </select>
    </div>

    <!-- Selector de vista -->
    <div class="view-selector">
        <label for="view_mode">Vista:</label>
        <select id="view_mode" name="view_mode" onchange="changeViewMode(this.value)">
            <option value="grid">Cuadrícula</option>
            <option value="list">Lista</option>
        </select>
    </div>
</div>

<!-- Contenedor de productos (dinámico según la vista) -->
<div id="filtered-products" class="products-container">
    <div id="product-container" class="product-grid-specific">
        @foreach($productos as $producto)
            <div class="product-card-specific">
                <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="product-image-link">
                    <img src="{{ asset('images/' . $producto->imagen_url) }}" class="product-image-specific" alt="{{ $producto->nombre }}" loading="lazy">
                </a>
                <div class="product-body-specific">
                    <h2 class="product-title-specific">{{ $producto->nombre }}</h2>
                    <p class="product-text-specific">{{ $producto->descripcion }}</p>
                    <div class="product-price-specific">
                        <span class="price-usd">${{ number_format($producto->precio_dolares, 2) }}</span>
                        <span class="price-pen">S/. {{ number_format($producto->precio_soles, 2) }}</span>
                    </div>
                    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="btn btn-primary">Ver Detalles</a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Paginación -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center mt-4">
        {{ $productos->onEachSide(1)->links('pagination::bootstrap-4') }}
    </ul>
</nav>
<script> 
    // Actualizar la cantidad de productos por página
function updatePerPage(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', value);
    window.location.href = url.toString();
}

// Cambiar la vista entre cuadrícula y lista
function changeViewMode(mode) {
    const productContainer = document.getElementById('product-container');
    if (mode === 'list') {
        productContainer.classList.remove('product-grid-specific');
        productContainer.classList.add('product-list-specific');
    } else {
        productContainer.classList.remove('product-list-specific');
        productContainer.classList.add('product-grid-specific');
    }

    // Guardar la preferencia de vista en localStorage
    localStorage.setItem('view_mode', mode);
}

// Cargar la vista guardada al cargar la página
document.addEventListener("DOMContentLoaded", function() {
    const savedViewMode = localStorage.getItem('view_mode') || 'grid';
    changeViewMode(savedViewMode);
    document.getElementById('view_mode').value = savedViewMode;
});
</script>