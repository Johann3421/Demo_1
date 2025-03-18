@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h1 class="h4 mb-0">Sub-Filtros y Opciones</h1>
            </div>
            <div class="card-body">
                <!-- Pestañas -->
                <ul class="nav nav-tabs" id="subFiltroTabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#subfiltros">Sub-Filtros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#opciones">Opciones</a>
                    </li>
                </ul>

                <div class="tab-content mt-3">
                    <!-- Sección de Sub-Filtros -->
                    <div class="tab-pane fade show active" id="subfiltros">
                        <div class="mb-4">
                            <a href="{{ route('panel.subfiltro.crear.subfiltro') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Crear Sub-Filtro
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Sub-Filtro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subFiltros as $subFiltro)
                                        <tr>
                                            <td>{{ $subFiltro->nombre }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('panel.subfiltro.editar.subfiltro', $subFiltro->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </a>
                                                    <form action="{{ route('panel.subfiltro.eliminar.subfiltro', $subFiltro->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Sección de Opciones -->
                    <div class="tab-pane fade" id="opciones">
                        <div class="mb-4">
                            <a href="{{ route('panel.subfiltro.crear.opcion') }}" class="btn btn-success">
                                <i class="fas fa-plus"></i> Crear Opción
                            </a>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Opción</th>
                                        <th>Sub-Filtro Asociado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subFiltros as $subFiltro)
                                        @foreach($subFiltro->opciones as $opcion)
                                            <tr>
                                                <td>{{ $opcion->nombre }}</td>
                                                <td>{{ $subFiltro->nombre }}</td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ route('panel.subfiltro.editar.opcion', $opcion->id) }}" class="btn btn-warning btn-sm">
                                                            <i class="fas fa-edit"></i> Editar
                                                        </a>
                                                        <form action="{{ route('panel.subfiltro.eliminar.opcion', $opcion->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm">
                                                                <i class="fas fa-trash"></i> Eliminar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
