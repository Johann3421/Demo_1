@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Gestión de Sub-Filtros y Opciones</h4>
            </div>
            <div class="card-body">
                <!-- Pestañas -->
                <ul class="nav nav-pills mb-3" id="formTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#subFiltroTab">
                            <i class="fas fa-filter"></i> Sub-Filtro
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#opcionTab">
                            <i class="fas fa-list"></i> Opción
                        </a>
                    </li>
                </ul>

                <!-- Contenedor de Formularios Siempre Visibles -->
                <div class="tab-content">
                    <!-- Formulario de Sub-Filtro -->
                    <div class="tab-pane fade show active" id="subFiltroTab">
                        <form action="{{ isset($subFiltro) ? route('panel.subfiltro.guardar.subfiltro', $subFiltro->id) : route('panel.subfiltro.guardar.subfiltro') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Sub-Filtro</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($subFiltro) ? $subFiltro->nombre : old('nombre') }}" required>
                            </div>

                            <!-- Campo para seleccionar la categoría -->
                            <div class="mb-3">
                                <label for="categoria_id" class="form-label">Categoría</label>
                                <select name="categoria_id" id="categoria_id" class="form-select" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" {{ (isset($subFiltro) && $subFiltro->categoria_id == $categoria->id) ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($subFiltro) ? 'Actualizar' : 'Crear' }}
                            </button>
                            <a href="{{ route('panel.subfiltro') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>

                    <!-- Formulario de Opción -->
                    <div class="tab-pane fade" id="opcionTab">
                        <form action="{{ isset($opcion) ? route('panel.subfiltro.guardar.opcion', $opcion->id) : route('panel.subfiltro.guardar.opcion') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Opción</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($opcion) ? $opcion->nombre : old('nombre') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sub_filtro_id" class="form-label">Sub-Filtro</label>
                                <select name="sub_filtro_id" id="sub_filtro_id" class="form-select" required>
                                    <option value="">Seleccione un sub-filtro</option>
                                    @foreach($subFiltros as $subFiltroOption)
                                        <option value="{{ $subFiltroOption->id }}" 
                                            data-categoria="{{ $subFiltroOption->categoria->nombre ?? 'Sin Categoría' }}" 
                                            {{ (isset($opcion) && $opcion->sub_filtro_id == $subFiltroOption->id) ? 'selected' : '' }}>
                                            {{ $subFiltroOption->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Mostrar la categoría asociada al subfiltro -->
                            <div class="mb-3">
                                <label class="form-label">Categoría del Sub-Filtro</label>
                                <input type="text" id="categoria_nombre" class="form-control" value="{{ isset($opcion) ? $opcion->subFiltro->categoria->nombre ?? '' : '' }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($opcion) ? 'Actualizar' : 'Crear' }}
                            </button>
                            <a href="{{ route('panel.subfiltro') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const subFiltroSelect = document.getElementById("sub_filtro_id");
            const categoriaNombre = document.getElementById("categoria_nombre");

            subFiltroSelect.addEventListener("change", function () {
                const selectedOption = subFiltroSelect.options[subFiltroSelect.selectedIndex];
                const categoria = selectedOption.getAttribute("data-categoria");
                categoriaNombre.value = categoria || '';
            });

            // Asegurar que la pestaña activa se muestre correctamente al recargar la página
            let activeTab = localStorage.getItem("activeTab");
            if (activeTab) {
                document.querySelector(".nav-link.active").classList.remove("active");
                document.querySelector(".tab-pane.show.active").classList.remove("show", "active");

                document.querySelector(`[href="${activeTab}"]`).classList.add("active");
                document.querySelector(activeTab).classList.add("show", "active");
            }

            document.querySelectorAll(".nav-link").forEach(tab => {
                tab.addEventListener("click", function () {
                    localStorage.setItem("activeTab", this.getAttribute("href"));
                });
            });
        });
    </script>
@endsection
