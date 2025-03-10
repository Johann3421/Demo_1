{{-- resources/views/partials/search.blade.php --}}
<form action="#" method="GET" class="search-form" id="search-form">
    <input type="text" name="query" placeholder="Buscar productos..." class="search-input" id="search-input" required>
    <button type="submit" class="search-button">Buscar</button>
    <div id="search-results" class="search-results"></div> <!-- Contenedor de resultados dentro del formulario -->
</form>

<style>
    /* Estilos CSS */
    .search-form {
        position: relative; /* Asegura que el contenedor de resultados sea relativo al formulario */
        display: flex;
        align-items: center;
        width: 200%; /* Asegura que el formulario ocupe el ancho disponible */
        max-width: 800px; /* Hace la barra de búsqueda más ancha */
        margin: 0 auto; /* Centra el buscador */
    }

    .search-input {
        width: 100%;
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .search-button {
        padding: 12px 24px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        margin-left: 10px;
        cursor: pointer;
    }

    .search-results {
        position: absolute;
        top: 100%; /* Coloca el contenedor de resultados justo debajo del input */
        left: 0;
        width: 100%; /* Ocupa el ancho del formulario */
        max-height: 400px;
        overflow-y: auto;
        background-color: white;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        display: none;
        z-index: 1000;
    }

    .search-results.active {
        display: block;
    }

    .search-results .result-item {
        display: flex;
        align-items: center;
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .search-results .result-item:hover {
        background-color: #f9f9f9;
    }

    .search-results .result-item img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 5px;
        margin-right: 15px;
    }

    .search-results .result-item .result-details {
        flex: 1;
    }

    .search-results .result-item .result-details h3 {
        margin: 0;
        font-size: 16px;
        color: #333;
    }

    .search-results .result-item .result-details p {
        margin: 5px 0 0;
        font-size: 14px;
        color: #666;
    }

    /* Responsive para celulares */
    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
            margin-bottom: 10px;
        }

        .search-button {
            width: 100%;
            margin-left: 0;
        }

        .search-results {
            width: 100%;
        }
    }
</style>

<script>
    // JavaScript
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchResults = document.getElementById('search-results');
        const searchForm = document.getElementById('search-form');

        // Lista de productos (simulando una base de datos)
        const products = [
            {
                id: 1,
                name: 'Laptop Lenovo IdeaPad Gaming 3 15IMH05',
                description: 'Intel Core i5, 8GB RAM, 512GB SSD, GTX 1650',
                image: "{{ asset('images/lenovo1.png') }}",
                price_usd: '$531.23',
                price_pen: 'S/. 1976.18',
                url: "{{ route('producto.detalles', ['id' => 1, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15imh05']) }}"
            },
            {
                id: 2,
                name: 'Laptop Lenovo IdeaPad Gaming 3 15ARH05',
                description: 'AMD Ryzen 7, 16GB RAM, 1TB HDD, 256GB SSD, GTX 1650 Ti',
                image: "{{ asset('images/lenovo2.png') }}",
                price_usd: '$1031.78',
                price_pen: 'S/. 3838.22',
                url: "{{ route('producto.detalles', ['id' => 2, 'slug' => 'laptop-lenovo-ideapad-gaming-3-15arh05']) }}"
            },
            {
                id: 3,
                name: 'Tarjeta de Video Gigabyte GTX 1660 Super',
                description: '6GB GDDR6',
                image: "{{ asset('images/gtx1.png') }}",
                price_usd: '$470.78',
                price_pen: 'S/. 1751.30',
                url: "{{ route('producto.detalles', ['id' => 3, 'slug' => 'tarjeta-video-gigabyte-gtx-1660-super']) }}"
            },
            {
                id: 4,
                name: 'Tarjeta de Video Gigabyte AORUS RTX 3070 Master',
                description: '8GB GDDR6',
                image: "{{ asset('images/gtx2.png') }}",
                price_usd: '$1105.00',
                price_pen: 'S/. 4110.60',
                url: "{{ route('producto.detalles', ['id' => 4, 'slug' => 'tarjeta-video-gigabyte-aorus-rtx-3070-master']) }}"
            },
            {
                id: 5,
                name: 'Monitor AOC 24" G2460PQU',
                description: '24 pulgadas, 144Hz, 1ms',
                image: "{{ asset('images/monitor1.png') }}",
                price_usd: '$186.40',
                price_pen: 'S/. 693.41',
                url: "{{ route('producto.detalles', ['id' => 5, 'slug' => 'monitor-aoc-24-g2460pqu']) }}"
            },
            {
                id: 6,
                name: 'Monitor Gigabyte G27FC',
                description: '27 pulgadas, 165Hz, curvatura 1500R',
                image: "{{ asset('images/monitor2.png') }}",
                price_usd: '$226.66',
                price_pen: 'S/. 843.18',
                url: "{{ route('producto.detalles', ['id' => 6, 'slug' => 'monitor-gigabyte-g27fc']) }}"
            }
        ];

        // Evento para mostrar resultados al escribir en el input
        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();
            const filteredProducts = products.filter(product => 
                product.name.toLowerCase().includes(query) || 
                product.description.toLowerCase().includes(query)
            );

            displayResults(filteredProducts);
        });

        // Función para mostrar los resultados
        function displayResults(results) {
            searchResults.innerHTML = '';
            if (results.length > 0) {
                results.forEach(product => {
                    const resultItem = document.createElement('div');
                    resultItem.classList.add('result-item');
                    resultItem.innerHTML = `
                        <img src="${product.image}" alt="${product.name}">
                        <div class="result-details">
                            <h3>${product.name}</h3>
                            <p>${product.description}</p>
                            <p><strong>${product.price_usd} | ${product.price_pen}</strong></p>
                        </div>
                    `;
                    resultItem.addEventListener('click', function () {
                        window.location.href = product.url; // Redirige a la página del producto
                    });
                    searchResults.appendChild(resultItem);
                });
                searchResults.classList.add('active');
            } else {
                searchResults.classList.remove('active');
            }
        }

        // Ocultar resultados al hacer clic fuera del formulario
        document.addEventListener('click', function (event) {
            if (!searchForm.contains(event.target)) {
                searchResults.classList.remove('active');
            }
        });
    });
</script>