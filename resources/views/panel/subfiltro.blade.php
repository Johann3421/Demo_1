@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                <h1 class="h4 mb-0">Gestión de Sub-Filtros y Opciones</h1>
            </div>
            <div class="card-body">
                <!-- Pestañas -->
                <ul class="nav nav-pills mb-3" id="subFiltroTabs">
                    <li class="nav-item">
                        <a class="nav-link {{ $activeTab === 'subfiltros' ? 'active' : '' }}" 
                           data-bs-toggle="tab" 
                           href="#subfiltros"
                           onclick="setActiveTab('subfiltros')">
                            <i class="fas fa-filter"></i> Sub-Filtros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ $activeTab === 'opciones' ? 'active' : '' }}" 
                           data-bs-toggle="tab" 
                           href="#opciones"
                           onclick="setActiveTab('opciones')">
                            <i class="fas fa-list"></i> Opciones
                        </a>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Sección de Sub-Filtros -->
                    <div class="tab-pane fade {{ $activeTab === 'subfiltros' ? 'show active' : '' }}" id="subfiltros">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold">Listado de Sub-Filtros</h5>
                            <div>
                                <select class="form-select d-inline w-auto" id="perPage" onchange="location = this.value;">
                                    <option value="?per_page=10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="?per_page=20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="?per_page=50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="?per_page=100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <a href="{{ route('panel.subfiltro.crear.subfiltro') }}" class="btn btn-primary">
                                    <i class="fas fa-plus"></i> Crear Sub-Filtro
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Sub-Filtro</th>
                                        <th>Categoría</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subFiltros as $subFiltro)
                                        <tr>
                                            <td>{{ $subFiltro->nombre }}</td>
                                            <td>{{ $subFiltro->categoria ? $subFiltro->categoria->nombre : '' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('panel.subfiltro.editar.subfiltro', $subFiltro->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i> Editar
                                                </a>
                                                <form action="{{ route('panel.subfiltro.eliminar.subfiltro', $subFiltro->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i> Eliminar
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
    {{ $subFiltros->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

                    </div>

                    <!-- Sección de Opciones -->
                    <div class="tab-pane fade {{ $activeTab === 'opciones' ? 'show active' : '' }}" id="opciones">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold">Listado de Opciones</h5>
                            <div>
                                <select class="form-select d-inline w-auto" id="perPage" onchange="location = this.value;">
                                    <option value="?per_page=10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="?per_page=20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                                    <option value="?per_page=50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                                    <option value="?per_page=100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                                </select>
                                <a href="{{ route('panel.subfiltro.crear.opcion') }}" class="btn btn-success">
                                    <i class="fas fa-plus"></i> Crear Opción
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Opción</th>
                                        <th>Sub-Filtro Asociado</th>
                                        <th>Categoría</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subFiltros as $subFiltro)
                                        @foreach($subFiltro->opciones as $opcion)
                                            <tr>
                                                <td>{{ $opcion->nombre }}</td>
                                                <td>{{ $subFiltro->nombre }}</td>
                                                <td>{{ $subFiltro->categoria ? $subFiltro->categoria->nombre : '' }}</td>
                                                <td class="text-center">
                                                    <a href="{{ route('panel.subfiltro.editar.opcion', $opcion->id) }}" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-edit"></i> Editar
                                                    </a>
                                                    <form action="{{ route('panel.subfiltro.eliminar.opcion', $opcion->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center mt-4">
    {{ $subFiltros->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Función para enviar la pestaña activa al servidor
        function setActiveTab(tab) {
            fetch(`{{ route('panel.subfiltro') }}?tab=${tab}`, {
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                },
            });
        }
    </script>
@endsection