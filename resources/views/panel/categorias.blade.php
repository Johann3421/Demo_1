@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">Categorías</h1>
            <div>
                <a href="{{ route('panel.categorias.crear') }}" class="btn btn-primary ms-3">
                    <i class="fas fa-plus me-2"></i>Crear Nueva Categoría
                </a>
            </div>
        </div>
        <form action="{{ route('panel.categorias') }}" method="GET" class="d-inline">
                    <label for="perPage" class="me-2">Mostrar:</label>
                    <select name="perPage" id="perPage" class="form-select d-inline w-auto" onchange="this.form.submit()">
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </form>

        <div class="card shadow-lg">
            <div class="card-body">
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
                                <th scope="col">Descripción</th>
                                <th scope="col">Imagen</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($categorias as $categoria)
                                <tr>
                                    <th scope="row">{{ $categoria->id }}</th>
                                    <td>{{ $categoria->nombre }}</td>
                                    <td>{{ Str::limit($categoria->descripcion, 50) }}</td>
                                    <td>
                                        @if ($categoria->imagen_url)
                                            <img src="{{ asset('images/' . $categoria->imagen_url) }}" 
                                                 alt="{{ $categoria->nombre }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 100px; height: auto;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.categorias.editar', $categoria->id) }}" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('panel.categorias.eliminar', $categoria->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    title="Eliminar" 
                                                    onclick="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No hay categorías registradas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Paginación -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div>
                        Mostrando {{ $categorias->firstItem() }} a {{ $categorias->lastItem() }} de {{ $categorias->total() }} categorías
                    </div>
                    <div>
                        {{ $categorias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection