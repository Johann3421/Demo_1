@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Gestión de Proveedores</h1>

        <!-- Botón para crear un nuevo proveedor -->
        <a href="{{ route('panel.proveedores.crear') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Crear Proveedor
        </a>

        <!-- Lista de proveedores -->
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th>URL</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($proveedores as $proveedor)
                                <tr>
                                    <td>{{ $proveedor->nombre }}</td>
                                    <td>
                                        <img src="{{ asset($proveedor->imagen_url) }}" alt="{{ $proveedor->alt_text }}" class="img-thumbnail" style="width: 80px; height: auto;">
                                    </td>
                                    <td>
                                        <a href="{{ $proveedor->url }}" target="_blank" class="text-decoration-none">
                                            {{ $proveedor->url }}
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('panel.proveedores.editar', $proveedor->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('panel.proveedores.eliminar', $proveedor->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este proveedor?')">
                                                <i class="fas fa-trash"></i>
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
    </div>
@endsection