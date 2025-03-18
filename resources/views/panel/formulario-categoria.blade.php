@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">{{ isset($categoria) ? 'Editar Categoría' : 'Crear Nueva Categoría' }}</h1>
            <a href="{{ route('panel.categorias') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <form action="{{ isset($categoria) ? route('panel.categorias.actualizar', $categoria->id) : route('panel.categorias.guardar') }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf
                    @if (isset($categoria)) @method('PUT') @endif

                    <div class="row g-3">
                        <!-- Nombre -->
                        <div class="col-md-6">
                            <label for="nombre" class="form-label fw-bold">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control" 
                                   value="{{ old('nombre', $categoria->nombre ?? '') }}" required>
                        </div>

                        <!-- Descripción -->
                        <div class="col-md-6">
                            <label for="descripcion" class="form-label fw-bold">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3">{{ old('descripcion', $categoria->descripcion ?? '') }}</textarea>
                        </div>

                        <!-- Imagen -->
                        <div class="col-md-6">
                            <label for="imagen_url" class="form-label fw-bold">Imagen</label>
                            <input type="file" name="imagen_url" id="imagen_url" class="form-control">
                            @if (isset($categoria) && $categoria->imagen_url)
                                <img src="{{ asset('images/' . $categoria->imagen_url) }}" 
                                     alt="{{ $categoria->nombre }}" 
                                     class="img-thumbnail mt-3" 
                                     style="max-width: 200px; height: auto;">
                            @endif
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>{{ isset($categoria) ? 'Actualizar Categoría' : 'Crear Categoría' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection