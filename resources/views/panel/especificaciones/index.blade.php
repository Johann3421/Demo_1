@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Especificaciones de {{ $producto->nombre }}</h1>
    <div class="card">
        <div class="card-body">
            <!-- Botón para crear nueva especificación -->
            <a href="{{ route('panel.especificaciones.create', $producto->id) }}" class="btn btn-primary mb-3">
                <i class="fas fa-plus me-2"></i> Crear Especificación
            </a>

            <!-- Botón para importar desde Excel -->
            <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#importarModal">
                <i class="fas fa-file-import me-2"></i> Importar desde Excel
            </button>

            <!-- Botón para eliminar todas las especificaciones -->
            @if($especificaciones->count() > 0)
            <button type="button" class="btn btn-danger mb-3" data-bs-toggle="modal" data-bs-target="#eliminarTodasModal">
                <i class="fas fa-trash-alt me-2"></i> Eliminar Todas
            </button>
            @endif

            <!-- Modal para importar desde Excel -->
            <div class="modal fade" id="importarModal" tabindex="-1" aria-labelledby="importarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="importarModalLabel">Importar Especificaciones</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('panel.especificaciones.importar', $producto->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="archivo" class="form-label">Seleccione un archivo Excel:</label>
                                    <input type="file" name="archivo" id="archivo" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Importar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal para confirmar eliminación de todas -->
            <div class="modal fade" id="eliminarTodasModal" tabindex="-1" aria-labelledby="eliminarTodasModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-danger text-white">
                            <h5 class="modal-title" id="eliminarTodasModalLabel">Confirmar Eliminación</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>¿Está seguro que desea eliminar TODAS las especificaciones de este producto?</p>
                            <p class="fw-bold">Esta acción no se puede deshacer.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <form action="{{ route('panel.especificaciones.destroyAll', $producto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar Todas</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lista de especificaciones -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Campo</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($especificaciones as $especificacion)
                        <tr>
                            <td>{{ $especificacion->campo }}</td>
                            <td>{{ $especificacion->descripcion }}</td>
                            <td>
                                <a href="{{ route('panel.especificaciones.edit', $especificacion->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i> Editar
                                </a>

                                <form action="{{ route('panel.especificaciones.destroy', $especificacion->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar esta especificación?')">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
