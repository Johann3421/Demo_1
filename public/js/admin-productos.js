// Drag & Drop
document.getElementById('drop-zone').addEventListener('click', function() {
    document.getElementById('imagen_url').click();
});

document.getElementById('imagen_url').addEventListener('change', function(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('vista_previa').src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
});

document.getElementById('drop-zone').addEventListener('dragover', function(event) {
    event.preventDefault();
    event.target.classList.add('bg-info');
});

document.getElementById('drop-zone').addEventListener('dragleave', function(event) {
    event.target.classList.remove('bg-info');
});

document.getElementById('drop-zone').addEventListener('drop', function(event) {
    event.preventDefault();
    document.getElementById('imagen_url').files = event.dataTransfer.files;
    document.getElementById('imagen_url').dispatchEvent(new Event('change'));
});

// Slug automático
document.getElementById('nombre').addEventListener('input', function() {
    let nombre = this.value;
    let slug = nombre.toLowerCase().replace(/ /g, '-').replace(/[^\w-]+/g, '');
    document.getElementById('slug').value = slug;
});

document.getElementById('slug').addEventListener('input', function() {
    let slug = this.value;
    let nombre = slug.replace(/-/g, ' ');
    document.getElementById('nombre').value = nombre;
});

// Botón de especificaciones (placeholder para futura implementación)
document.getElementById('btn-especificaciones').addEventListener('click', function() {
    alert('Funcionalidad de añadir especificaciones estará disponible pronto.');
});

// Obtener referencias a los elementos del formulario
const categoriaSelect = document.getElementById('categoria_id');
const grupoSelect = document.getElementById('grupo_id');
const subgrupoSelect = document.getElementById('subgrupo_id');

// Evento cuando se selecciona una categoría
categoriaSelect.addEventListener('change', function() {
    const categoriaId = this.value;

    // Limpiar y deshabilitar los selects de grupo y subgrupo
    grupoSelect.innerHTML = '<option value="">Seleccione un grupo</option>';
    subgrupoSelect.innerHTML = '<option value="">Seleccione un subgrupo</option>';
    grupoSelect.disabled = true;
    subgrupoSelect.disabled = true;

    if (categoriaId) {
        // Hacer una solicitud AJAX para obtener los grupos de la categoría seleccionada
        fetch(`/panel/grupos-por-categoria/${categoriaId}`)
            .then(response => response.json())
            .then(data => {
                // Habilitar el select de grupos
                grupoSelect.disabled = false;

                // Llenar el select de grupos con los datos obtenidos
                data.forEach(grupo => {
                    const option = document.createElement('option');
                    option.value = grupo.id;
                    option.textContent = grupo.nombre;
                    grupoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener los grupos:', error));
    }
});

// Evento cuando se selecciona un grupo
grupoSelect.addEventListener('change', function() {
    const grupoId = this.value;

    // Limpiar y deshabilitar el select de subgrupos
    subgrupoSelect.innerHTML = '<option value="">Seleccione un subgrupo</option>';
    subgrupoSelect.disabled = true;

    if (grupoId) {
        // Hacer una solicitud AJAX para obtener los subgrupos del grupo seleccionado
        fetch(`/panel/subgrupos-por-grupo/${grupoId}`)
            .then(response => response.json())
            .then(data => {
                // Habilitar el select de subgrupos
                subgrupoSelect.disabled = false;

                // Llenar el select de subgrupos con los datos obtenidos
                data.forEach(subgrupo => {
                    const option = document.createElement('option');
                    option.value = subgrupo.id;
                    option.textContent = subgrupo.nombre;
                    subgrupoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error al obtener los subgrupos:', error));
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const precioDolares = document.getElementById('precio_dolares');
    const precioSoles = document.getElementById('precio_soles');
    const tasaCambio = 3.70;

    // Flag para evitar bucles infinitos
    let isConverting = false;

    function esNumeroValido(valor) {
        return !isNaN(parseFloat(valor)) && isFinite(valor) && valor !== '';
    }

    function convertirDolaresASoles() {
        if (isConverting) return;

        if (esNumeroValido(precioDolares.value)) {
            isConverting = true;
            precioSoles.value = (parseFloat(precioDolares.value) * tasaCambio).toFixed(2);
            setTimeout(() => isConverting = false, 100);
        }
    }

    function convertirSolesADolares() {
        if (isConverting) return;

        if (esNumeroValido(precioSoles.value)) {
            isConverting = true;
            precioDolares.value = (parseFloat(precioSoles.value) / tasaCambio).toFixed(2);
            setTimeout(() => isConverting = false, 100);
        }
    }

    // Eventos mejorados
    precioDolares.addEventListener('input', function() {
        if (!isConverting && this === document.activeElement) {
            convertirDolaresASoles();
        }
    });

    precioSoles.addEventListener('input', function() {
        if (!isConverting && this === document.activeElement) {
            convertirSolesADolares();
        }
    });

    // Eventos para cuando pierden el foco
    precioDolares.addEventListener('blur', convertirDolaresASoles);
    precioSoles.addEventListener('blur', convertirSolesADolares);

    // Convertir al cargar si hay valores
    if (esNumeroValido(precioDolares.value)) {
        convertirDolaresASoles();
    } else if (esNumeroValido(precioSoles.value)) {
        convertirSolesADolares();
    }
});
