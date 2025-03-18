@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">{{ isset($subgrupo) ? 'Editar Subgrupo' : 'Crear Nuevo Subgrupo' }}</h1>
            <a href="{{ route('panel.filtros') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ isset($subgrupo) ? route('panel.filtros.subgrupos.actualizar', $subgrupo->id) : route('panel.filtros.subgrupos.guardar') }}" 
                      method="POST">
                    @csrf
                    @if (isset($subgrupo)) @method('PUT') @endif

                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" 
                                   value="{{ old('nombre', $subgrupo->nombre ?? '') }}" required>
                        </div>

                        <!-- Grupo -->
                        <div class="col-md-6">
                            <label for="grupo_id" class="form-label fw-bold">Grupo</label>
                            <select name="grupo_id" id="grupo_id" class="form-control" required>
                                <option value="">Seleccione un grupo</option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->id }}" 
                                        {{ (isset($subgrupo) && $subgrupo->grupo_id == $grupo->id) ? 'selected' : '' }}>
                                        {{ $grupo->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>{{ isset($subgrupo) ? 'Actualizar Subgrupo' : 'Crear Subgrupo' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection