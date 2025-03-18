@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">{{ isset($grupo) ? 'Editar Grupo' : 'Crear Nuevo Grupo' }}</h1>
            <a href="{{ route('panel.filtros') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ isset($grupo) ? route('panel.filtros.grupos.actualizar', $grupo->id) : route('panel.filtros.grupos.guardar') }}" 
                      method="POST">
                    @csrf
                    @if (isset($grupo)) @method('PUT') @endif

                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" 
                                   value="{{ old('nombre', $grupo->nombre ?? '') }}" required>
                        </div>

                        <!-- Categoría -->
                        <div class="col-md-6">
                            <label for="categoria_id" class="form-label fw-bold">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="form-control" required>
                                <option value="">Seleccione una categoría</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" 
                                        {{ (isset($grupo) && $grupo->categoria_id == $categoria->id) ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>{{ isset($grupo) ? 'Actualizar Grupo' : 'Crear Grupo' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection