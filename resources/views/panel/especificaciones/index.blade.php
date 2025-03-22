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
                                <!-- resources/views/panel/especificaciones/index.blade.php -->
<a href="{{ route('panel.especificaciones.edit', $especificacion->id) }}" class="btn btn-sm btn-warning">
    <i class="fas fa-edit"></i> Editar
</a>
                                
                                <!-- resources/views/panel/especificaciones/index.blade.php -->
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