@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">Banners</h1>
            <a href="{{ route('panel.banners.crear') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Crear Nuevo Banner
            </a>
        </div>

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
                                <th scope="col">Imagen</th>
                                <th scope="col">Enlace</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $slider->id }}</th>
                                    <td>
                                        @if ($slider->imagen_url)
                                            <img src="{{ asset($slider->imagen_url) }}" 
                                                 alt="Banner {{ $slider->id }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 150px; height: auto;">
                                        @else
                                            <span class="text-muted">Sin imagen</span>
                                        @endif
                                    </td>
                                    <td>{{ $slider->enlace ?? 'Sin enlace' }}</td>
                                    <td>
                                        <a href="{{ route('panel.banners.editar', $slider->id) }}" 
                                           class="btn btn-sm btn-warning" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('panel.banners.eliminar', $slider->id) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                    title="Eliminar" 
                                                    onclick="return confirm('¿Estás seguro de eliminar este banner?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No hay banners registrados.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection