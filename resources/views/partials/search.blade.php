{{-- resources/views/partials/search.blade.php --}}
<form action="{{ route('productos.search') }}" method="GET" class="search-form" id="search-form">
    <div class="search-input-wrapper">
        <input type="text" name="query" placeholder="Buscar productos..." class="search-input" id="search-input" required>
        <!-- Icono de lupa SVG -->
        <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
        </svg>
    </div>
    <div id="search-results" class="search-results"></div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        const searchForm = document.getElementById('search-form');

        // Evento para el autocompletado
        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim();

            if (query.length === 0) {
                searchResults.innerHTML = "";
                searchResults.classList.remove("active");
                return;
            }

            fetch(`/buscar-productos?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    displayResults(data);
                })
                .catch(error => console.error("Error al obtener los productos:", error));
        });

        // Evento para el submit del formulario
        searchForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const query = searchInput.value.trim();

            if (query.length > 0) {
                window.location.href = `/productos?query=${encodeURIComponent(query)}`;
            }
        });

        function displayResults(results) {
            searchResults.innerHTML = '';

            if (results.length > 0) {
                results.forEach(producto => {
                    const resultItem = document.createElement('div');
                    resultItem.classList.add('result-item');
                    resultItem.innerHTML = `
                        <img src="/images/${producto.imagen_url}" alt="${producto.nombre}">
                        <div class="result-details">
                            <h3>${producto.nombre}</h3>
                            <p>${producto.descripcion}</p>
                            <p><strong>$${producto.precio_dolares} | S/. ${(producto.precio_dolares * 3.8).toFixed(2)}</strong></p>
                        </div>
                    `;

                    resultItem.addEventListener('click', function () {
                        window.location.href = `/producto/${producto.id}/${producto.slug}`;
                    });

                    searchResults.appendChild(resultItem);
                });

                searchResults.classList.add('active');
            } else {
                searchResults.classList.remove('active');
            }
        }

        document.addEventListener('click', function (event) {
            if (!searchForm.contains(event.target)) {
                searchResults.classList.remove('active');
            }
        });
    });
</script>
