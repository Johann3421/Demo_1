<div class="card shadow-lg mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary fw-bold">Subgrupos</h2>
            <div>
                <!-- Buscador -->
                <form action="{{ route('panel.filtros') }}" method="GET" class="d-inline-block me-3">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Buscar subgrupo..."
                               value="{{ request('search') }}" aria-label="Buscar">
                        <input type="hidden" name="activeTab" value="subgrupos">
                        <input type="hidden" name="perPage" value="{{ $perPage }}">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                        @if(request('search'))
                            <a href="{{ route('panel.filtros', ['activeTab' => 'subgrupos', 'perPage' => $perPage]) }}"
                               class="btn btn-outline-danger" title="Limpiar búsqueda">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </div>
                </form>

                <a href="{{ route('panel.filtros.subgrupos.crear') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Crear Nuevo Subgrupo
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
                        <th scope="col">Grupo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($subgrupos as $subgrupo)
                        <tr>
                            <th scope="row">{{ $subgrupo->id }}</th>
                            <td>{{ $subgrupo->nombre }}</td>
                            <td>{{ $subgrupo->grupo->nombre }}</td>
                            <td>
                                <a href="{{ route('panel.filtros.subgrupos.editar', $subgrupo->id) }}"
                                   class="btn btn-sm btn-warning" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('panel.filtros.subgrupos.eliminar', $subgrupo->id) }}"
                                      method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                            title="Eliminar"
                                            onclick="return confirm('¿Estás seguro de eliminar este subgrupo?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">
                                @if(request('search'))
                                    No se encontraron subgrupos con "{{ request('search') }}"
                                @else
                                    No hay subgrupos registrados.
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $subgrupos->onEachSide(1)
                ->appends([
                    'activeTab' => 'subgrupos',
                    'perPage' => $perPage,
                    'search' => request('search')
                ])
                ->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
