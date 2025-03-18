<div class="card shadow-lg mt-4">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="text-secondary fw-bold">Grupos</h2>
            <a href="{{ route('panel.filtros.grupos.crear') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Crear Nuevo Grupo
            </a>
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
                            <td colspan="4" class="text-center">No hay grupos registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación compacta con Bootstrap 5 -->
<div class="d-flex justify-content-center mt-4">
    {{ $grupos->onEachSide(1)->links('pagination::bootstrap-5') }}
</div>
    </div>
</div>