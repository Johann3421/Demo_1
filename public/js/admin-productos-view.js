// Cache de elementos DOM
const domCache = {
    searchInput: document.getElementById('searchInput'),
    clearSearch: document.getElementById('clearSearch'),
    perPage: document.getElementById('perPage'),
    searchForm: document.getElementById('searchForm'),
    productsTableBody: document.getElementById('productsTableBody')
};

// Función optimizada para aplicar filtro local
function applyLocalFilter(searchTerm) {
    const rows = domCache.productsTableBody.querySelectorAll('.product-row');
    const term = searchTerm.toLowerCase();

    // Usamos requestAnimationFrame para mejor rendimiento
    requestAnimationFrame(() => {
        rows.forEach(row => {
            const text = row.querySelector('.searchable').textContent.toLowerCase();
            row.style.display = text.includes(term) ? '' : 'none';
        });
    });
}

// Delegación de eventos para mejor performance
function setupEventListeners() {
    // Búsqueda en tiempo real con debounce
    let searchTimeout;
    domCache.searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        applyLocalFilter(searchTerm);

        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            domCache.searchForm.submit();
        }, 800);
    });

    // Limpiar búsqueda
    domCache.clearSearch.addEventListener('click', function() {
        domCache.searchInput.value = '';
        domCache.searchForm.submit();
    });

    // Cambiar elementos por página
    domCache.perPage.addEventListener('change', function() {
        domCache.searchForm.submit();
    });

    // Delegación de eventos para los botones de eliminar
    domCache.productsTableBody.addEventListener('click', function(e) {
        if (e.target.closest('.btn-eliminar')) {
            e.preventDefault();
            const button = e.target.closest('.btn-eliminar');
            const productId = button.getAttribute('data-id');
            const deleteUrl = button.getAttribute('data-url');

            handleDeleteProduct(productId, deleteUrl);
        }
    });
}

// Función optimizada para manejar eliminación
async function handleDeleteProduct(productId, deleteUrl) {
    try {
        const result = await Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        });

        if (result.isConfirmed) {
            const response = await fetch(deleteUrl, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                }
            });

            const data = await response.json();

            if (data.success) {
                await Swal.fire('Eliminado!', data.message, 'success');
                // Eliminar la fila directamente sin recargar la página
                document.querySelector(`.product-row[data-id="${productId}"]`).remove();
            } else {
                await Swal.fire('Error!', data.message, 'error');
            }
        }
    } catch (error) {
        await Swal.fire('Error!', 'Ocurrió un error al intentar eliminar el producto.', 'error');
        console.error('Error al eliminar producto:', error);
    }
}

// Inicialización cuando el DOM está listo
document.addEventListener('DOMContentLoaded', function() {
    // Aplicar filtro inicial si existe
    if (domCache.searchInput.value) {
        applyLocalFilter(domCache.searchInput.value.toLowerCase());
    }

    // Configurar event listeners
    setupEventListeners();
});

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.visibility-toggle').forEach(toggle => {
        toggle.addEventListener('change', function() {
            const productId = this.dataset.id;
            const isVisible = this.checked;

            fetch(`/panel/productos/${productId}/visibility`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ visible: isVisible })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    const badge = this.closest('td').querySelector('.badge');
                    badge.className = `badge bg-${data.visible ? 'success' : 'danger'} ms-2`;
                    badge.textContent = data.visible ? 'Sí' : 'No';
                } else {
                    this.checked = !isVisible; // Revertir cambio
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                this.checked = !isVisible; // Revertir cambio
            });
        });
    });
});
