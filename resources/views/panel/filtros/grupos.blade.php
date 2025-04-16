<div class="card shadow-lg mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary fw-bold">Grupos</h2>
            <div>
                <!-- Buscador -->
                <form action="{{ route('panel.filtros') }}" method="GET" class="d-inline-block me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar grupo..."
                               value="{{ request('search') }}" aria-label="Buscar">
                        <input type="hidden" name="activeTab" value="grupos">
                        <input type="hidden" name="perPage" value="{{ $perPage }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('panel.filtros', ['activeTab' => 'grupos', 'perPage' => $perPage]) }}"
                               class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('panel.filtros.grupos.crear') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Crear Nuevo Grupo
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($grupos as $grupo)
                        <tr>
                            <th scope="row">{{ $grupo->id }}</th>
                            <td>{{ $grupo->nombre }}</td>
                            <td>{{ $grupo->categoria->nombre }}</td>
                            <td>
                                <a href="{{ route('panel.filtros.grupos.editar', $grupo->id) }}"
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('panel.filtros.grupos.eliminar', $grupo->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            title="Eliminar"
                                            onclick="return confirm('¿Estás seguro de eliminar este grupo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                @if(request('search'))
                                    No se encontraron grupos con "{{ request('search') }}"
                                @else
                                    No hay grupos registrados.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $grupos->onEachSide(1)
                ->appends([
                    'activeTab' => 'grupos',
                    'perPage' => $perPage,
                    'search' => request('search')
                ])
                ->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
