{{-- resources/views/partials/search.blade.php --}}
<form action="#" method="GET" class="search-form" id="search-form">
    <input type="text" name="query" placeholder="Buscar productos..." class="search-input" id="search-input" required>
    <div id="search-results" class="search-results"></div> <!-- Contenedor de resultados dentro del formulario -->
</form>


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