{{-- resources/views/partials/search.blade.php --}}
<form action="#" method="GET" class="search-form" id="search-form">
    <input type="text" name="query" placeholder="Buscar productos..." class="search-input" id="search-input" required>
    <div id="search-results" class="search-results"></div> <!-- Contenedor de resultados dentro del formulario -->
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        const searchForm = document.getElementById('search-form');

        searchInput.addEventListener('input', function () {
            const query = searchInput.value.trim();

            if (query.length === 0) {
                searchResults.innerHTML = "";
                searchResults.classList.remove("active");
                return;
            }

            fetch(`/buscar-productos?query=${query}`)
                .then(response => response.json())
                .then(data => {
                    displayResults(data);
                })
                .catch(error => console.error("Error al obtener los productos:", error));
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
