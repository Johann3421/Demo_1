document.addEventListener("DOMContentLoaded", function () {
    // FILTRADO DE CATEGORÍAS Y SUBFILTROS
    const categoriaSelect = document.getElementById("categoria-select");
    const subFiltrosContainer = document.getElementById("subfiltros-container");
    const subFiltrosList = document.getElementById("subfiltros-list");

    if (categoriaSelect) {
        categoriaSelect.addEventListener("change", function () {
            const categoriaId = this.value;
            subFiltrosList.innerHTML = "";
            subFiltrosContainer.classList.add("hidden");

            if (categoriaId) {
                fetch(`/api/subfiltros/${categoriaId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length > 0) {
                            subFiltrosContainer.classList.remove("hidden");
                            data.forEach(subFiltro => {
                                let subFiltroSection = document.createElement("div");
                                subFiltroSection.classList.add("mb-4");

                                let label = document.createElement("div");
                                label.classList.add("subfiltro-label");
                                label.textContent = subFiltro.nombre;
                                label.addEventListener("click", function () {
                                    optionsContainer.classList.toggle("show");
                                });

                                let optionsContainer = document.createElement("div");
                                optionsContainer.classList.add("subfiltro-options");

                                subFiltro.opciones.forEach(opcion => {
                                    let optionLabel = document.createElement("label");
                                    optionLabel.classList.add("checkbox-label");

                                    let checkbox = document.createElement("input");
                                    checkbox.type = "checkbox";
                                    checkbox.name = `filtros[${subFiltro.nombre}][]`;
                                    checkbox.value = opcion.nombre;

                                    let optionText = document.createElement("span");
                                    optionText.textContent = opcion.nombre;

                                    optionLabel.appendChild(checkbox);
                                    optionLabel.appendChild(optionText);
                                    optionsContainer.appendChild(optionLabel);
                                });

                                subFiltroSection.appendChild(label);
                                subFiltroSection.appendChild(optionsContainer);
                                subFiltrosList.appendChild(subFiltroSection);
                            });
                        }
                    })
                    .catch(error => console.error("Error al obtener subfiltros:", error));
            }
        });
    }

    // EFECTO DE CARGA DE PRODUCTOS
    setTimeout(function () {
        document.querySelectorAll('.product-card-specific').forEach(card => {
            card.style.opacity = '1';
        });
    }, 500);

    // ACTUALIZAR CANTIDAD DE PRODUCTOS POR PÁGINA
    window.updatePerPage = function (value) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', value);
        window.location.href = url.toString();
    };

    // CAMBIAR VISTA ENTRE CUADRÍCULA Y LISTA
    window.changeViewMode = function (mode) {
        const productContainer = document.getElementById('product-container');
        if (mode === 'list') {
            productContainer.classList.remove('product-grid-specific');
            productContainer.classList.add('product-list-specific');
        } else {
            productContainer.classList.remove('product-list-specific');
            productContainer.classList.add('product-grid-specific');
        }
        localStorage.setItem('view_mode', mode);
    };

    const savedViewMode = localStorage.getItem('view_mode') || 'grid';
    changeViewMode(savedViewMode);
    const viewModeSelector = document.getElementById('view_mode');
    if (viewModeSelector) {
        viewModeSelector.value = savedViewMode;
    }

    // FILTRO DE PRODUCTOS
    const filterForm = document.getElementById("filter-form");
    if (filterForm) {
        filterForm.addEventListener("submit", function (event) {
            event.preventDefault();
            const formData = new FormData(filterForm);
            const queryString = new URLSearchParams(formData).toString();
            window.location.href = window.location.pathname + '?' + queryString;
        });
    }

    // FILTROS Y BOTÓN DE APLICAR FILTROS
    const filterButton = document.getElementById('filter-button');
    if (filterForm && filterButton) {
        filterButton.addEventListener('click', function (e) {
            e.preventDefault();
            const formData = new FormData(filterForm);
            const params = new URLSearchParams();
            for (const [key, value] of formData.entries()) {
                if (value) {
                    params.append(key, value);
                }
            }
            const baseUrl = '/productos';
            const queryString = params.toString();
            const fullUrl = queryString ? `${baseUrl}?${queryString}` : baseUrl;
            window.location.href = fullUrl;
        });
    }

    // ACTUALIZAR LABEL DEL PRECIO
    const priceInput = document.getElementById('price');
    const priceLabel = document.getElementById('price-label');
    if (priceInput && priceLabel) {
        priceInput.addEventListener('input', function () {
            priceLabel.textContent = '$' + this.value;
        });
    }

    // TOGGLE SIDEBAR
    window.toggleSidebar = function () {
        document.querySelector('.filters-wrapper').classList.toggle('show');
    };
});
function toggleSidebar() {
    document.querySelector('.filters-wrapper').classList.toggle('show');
}

// Cierra el sidebar al hacer clic fuera de él
document.addEventListener('click', function(event) {
    const sidebar = document.querySelector('.filters-wrapper');
    const toggleBtn = document.querySelector('.sidebar-toggle');

    if (!sidebar.contains(event.target) && event.target !== toggleBtn && !toggleBtn.contains(event
        .target)) {
        sidebar.classList.remove('show');
    }
});
document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.querySelector(".filters-wrapper");
    const overlay = document.createElement("div");
    overlay.classList.add("sidebar-overlay");
    document.body.appendChild(overlay);

    // Botón para abrir
    document.querySelector(".sidebar-toggle").addEventListener("click", function() {
        sidebar.classList.add("show");
        overlay.classList.add("active");
    });

    // Cerrar al hacer clic fuera
    overlay.addEventListener("click", function() {
        sidebar.classList.remove("show");
        overlay.classList.remove("active");
    });

    // Botón de cerrar
    const closeButton = document.createElement("button");
    closeButton.innerText = "X";
    closeButton.classList.add("sidebar-close");
    sidebar.appendChild(closeButton);

    closeButton.addEventListener("click", function() {
        sidebar.classList.remove("show");
        overlay.classList.remove("active");
    });
});

function changeViewMode(mode) {
    const container = document.getElementById('product-container');
    if (mode === 'list') {
        container.classList.add('list-view');
    } else {
        container.classList.remove('list-view');
    }
    // Opcional: Guardar preferencia en localStorage
    localStorage.setItem('viewMode', mode);
    }


    document.addEventListener('DOMContentLoaded', function() {
    const savedMode = localStorage.getItem('viewMode') || 'grid';
    changeViewMode(savedMode);
    document.getElementById('view_mode').value = savedMode;
    });

    function updatePerPage(value) {
    // Lógica para actualizar productos por página
    const url = new URL(window.location.href);
    url.searchParams.set('per_page', value);
    window.location.href = url.toString();
    }
