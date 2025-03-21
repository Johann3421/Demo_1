@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-dark text-white">
            <h4>Asignar Opciones a Productos</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('panel.productos.guardar_opciones') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="producto_id" class="form-label">Seleccionar Producto</label>
                    <select class="form-select" id="producto_id" name="producto_id" required>
                        <option value="" selected disabled>Seleccione un producto</option>
                        @foreach($productos as $producto)
                            <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="subfiltro_id" class="form-label">Seleccionar Sub-Filtro</label>
                    <select class="form-select" id="subfiltro_id" name="subfiltro_id" required>
                        <option value="" selected disabled>Seleccione un subfiltro</option>
                        @foreach($subFiltros as $subFiltro)
                            <option value="{{ $subFiltro->id }}" data-categoria="{{ $subFiltro->categoria->nombre }}">
                                {{ $subFiltro->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Mostrar Categoría del Subfiltro -->
                <div class="mb-3">
                    <label class="form-label">Categoría del Sub-Filtro</label>
                    <div id="categoria-container" class="border p-3 rounded bg-light text-dark fw-bold">
                        <p class="text-muted">Seleccione un subfiltro para ver la categoría.</p>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Opciones Disponibles</label>
                    <div id="opciones-container" class="border p-3 rounded">
                        <p class="text-muted">Seleccione un subfiltro primero.</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Guardar Asignación</button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const subFiltroSelect = document.getElementById("subfiltro_id");
    const opcionesContainer = document.getElementById("opciones-container");
    const categoriaContainer = document.getElementById("categoria-container");

    subFiltroSelect.addEventListener("change", function () {
        const subFiltroId = this.value;
        const selectedOption = this.options[this.selectedIndex];
        const categoriaNombre = selectedOption.dataset.categoria;

        // Mostrar la categoría en el contenedor
        categoriaContainer.innerHTML = `<p class="fw-bold text-dark">${categoriaNombre}</p>`;

        if (subFiltroId) {
            fetch(`/api/opciones/${subFiltroId}`)
                .then(response => response.json())
                .then(data => {
                    opcionesContainer.innerHTML = "";
                    data.forEach(opcion => {
                        let checkbox = document.createElement("input");
                        checkbox.type = "checkbox";
                        checkbox.name = "opciones[]";
                        checkbox.value = opcion.id;
                        checkbox.classList.add("me-2");

                        let label = document.createElement("label");
                        label.textContent = opcion.nombre;
                        label.classList.add("d-block");

                        opcionesContainer.appendChild(checkbox);
                        opcionesContainer.appendChild(label);
                    });
                })
                .catch(error => console.error("Error al obtener opciones:", error));
        }
    });
});
</script>
@endsection
