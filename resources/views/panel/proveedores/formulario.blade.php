@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">{{ isset($proveedor) ? 'Editar Proveedor' : 'Crear Proveedor' }}</h1>

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ isset($proveedor) ? route('panel.proveedores.actualizar', $proveedor->id) : route('panel.proveedores.guardar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($proveedor))
                        @method('PUT')
                    @endif

                    <!-- Campo: Nombre -->
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ isset($proveedor) ? $proveedor->nombre : old('nombre') }}" required>
                    </div>

                    <!-- Campo: Imagen -->
                    <div class="mb-3">
                        <label for="imagen_url" class="form-label">Imagen</label>
                        <input type="file" name="imagen_url" id="imagen_url" class="form-control" onchange="previewImage(event)" {{ !isset($proveedor) ? 'required' : '' }}>
                        <div class="mt-2">
                            <img id="imagePreview" src="{{ isset($proveedor) ? asset($proveedor->imagen_url) : 'https://via.placeholder.com/150' }}" alt="Vista previa de la imagen" class="img-thumbnail" style="max-width: 150px; height: auto;">
                        </div>
                    </div>

                    <!-- Campo: URL -->
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="url" name="url" id="url" class="form-control" value="{{ isset($proveedor) ? $proveedor->url : old('url') }}">
                    </div>

                    <!-- Campo: Texto Alternativo (SEO) -->
                    <div class="mb-3">
                        <label for="alt_text" class="form-label">Texto Alternativo (SEO)</label>
                        <input type="text" name="alt_text" id="alt_text" class="form-control" value="{{ isset($proveedor) ? $proveedor->alt_text : old('alt_text') }}" required>
                    </div>

                    <!-- Botón de envío -->
                    <button type="submit" class="btn btn-primary">
                        {{ isset($proveedor) ? 'Actualizar' : 'Crear' }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para la vista previa de la imagen -->
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            const imagePreview = document.getElementById('imagePreview');

            reader.onload = function() {
                imagePreview.src = reader.result;
            };

            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            } else {
                imagePreview.src = "https://via.placeholder.com/150"; // Imagen por defecto
            }
        }
    </script>
@endsection