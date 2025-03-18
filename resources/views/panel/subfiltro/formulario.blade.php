@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Gestión de Sub-Filtros y Opciones</h1>
            </div>
            <div class="card-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="formTabs">
                    <li class="nav-item">
                        <a class="nav-link {{ isset($subFiltro) ? 'active' : '' }}" data-bs-toggle="tab" href="#subFiltroTab">Sub-Filtro</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ isset($opcion) && !isset($subFiltro) ? 'active' : '' }}" data-bs-toggle="tab" href="#opcionTab">Opción</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- Formulario de Sub-Filtro -->
                    <div class="tab-pane fade {{ isset($subFiltro) ? 'show active' : '' }}" id="subFiltroTab">
                        <form action="{{ isset($subFiltro) ? route('panel.subfiltro.guardar.subfiltro', $subFiltro->id) : route('panel.subfiltro.guardar.subfiltro') }}" method="POST">
                            @csrf
                            @if(isset($subFiltro))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre del Sub-Filtro</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($subFiltro) ? $subFiltro->nombre : old('nombre') }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ isset($subFiltro) ? 'Actualizar' : 'Crear' }}
                            </button>
                            <a href="{{ route('panel.subfiltro') }}" class="btn btn-secondary">Cancelar</a>
                        </form>
                    </div>

                    <!-- Formulario de Opción -->
                    <div class="tab-pane fade {{ isset($opcion) && !isset($subFiltro) ? 'show active' : '' }}" id="opcionTab">
                        <form action="{{ isset($opcion) ? route('panel.subfiltro.guardar.opcion', $opcion->id) : route('panel.subfiltro.guardar.opcion') }}" method="POST">
                            @csrf
                            @if(isset($opcion))
                                @method('PUT')
                            @endif

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Opción</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($opcion) ? $opcion->nombre : old('nombre') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="sub_filtro_id" class="form-label">Sub-Filtro</label>
                                <select name="sub_filtro_id" id="sub_filtro_id" class="form-control" required>
                                    <option value="">Seleccione un sub-filtro</option>
                                    @foreach($subFiltros as $subFiltroOption)
                                        <option value="{{ $subFiltroOption->id }}" {{ (isset($opcion) && $opcion->sub_filtro_id == $subFiltroOption->id) ? 'selected' : '' }}>
                                            {{ $subFiltroOption->nombre }}
                                        </option>
                                    @endforeach
                                </select>
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
@endsection
