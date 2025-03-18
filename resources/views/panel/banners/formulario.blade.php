@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">{{ isset($slider) ? 'Editar Banner' : 'Crear Nuevo Banner' }}</h1>
            <a href="{{ route('panel.banners') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="card shadow-lg">
            <div class="card-body">
                <!-- Mostrar mensajes de éxito o error -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form action="{{ isset($slider) ? route('panel.banners.actualizar', $slider->id) : route('panel.banners.guardar') }}" 
                      method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf
                    @if (isset($slider)) @method('PUT') @endif

                    <div class="row g-3">
                        <!-- Imagen -->
                        <div class="col-md-6">
                            <label for="imagen_url" class="form-label fw-bold">Imagen</label>
                            <div class="drop-zone" id="dropZone">
                                <span class="drop-zone__prompt">
                                    Arrastra y suelta la imagen aquí o haz clic para seleccionar
                                </span>
                                <input type="file" name="imagen_url" id="imagen_url" class="drop-zone__input" {{ !isset($slider) ? 'required' : '' }}>
                            </div>
                            <div id="imagePreview" class="mt-3">
                                @if (isset($slider) && $slider->imagen_url)
                                    <img src="{{ asset($slider->imagen_url) }}" 
                                         alt="Banner {{ $slider->id }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 100%; height: auto;">
                                @endif
                            </div>
                        </div>

                        <!-- Enlace -->
                        <div class="col-md-6">
                            <label for="enlace" class="form-label fw-bold">Enlace</label>
                            <input type="url" name="enlace" id="enlace" class="form-control" 
                                   value="{{ old('enlace', $slider->enlace ?? '') }}">
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>{{ isset($slider) ? 'Actualizar Banner' : 'Crear Banner' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <style>
        /* Estilos para la zona de arrastrar y soltar */
        .drop-zone {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.3s ease;
            position: relative;
        }

        .drop-zone__prompt {
            color: #666;
            font-size: 16px;
        }

        .drop-zone--over {
            border-color: #007bff;
        }

        .drop-zone__input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .img-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>

    <script>
        // Script para manejar la funcionalidad de arrastrar y soltar
        document.addEventListener('DOMContentLoaded', function () {
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.querySelector('.drop-zone__input');
            const imagePreview = document.getElementById('imagePreview');

            // Manejar el evento de arrastrar sobre la zona
            dropZone.addEventListener('dragover', (e) => {
                e.preventDefault();
                dropZone.classList.add('drop-zone--over');
            });

            // Manejar el evento de salir de la zona
            ['dragleave', 'dragend'].forEach((type) => {
                dropZone.addEventListener(type, () => {
                    dropZone.classList.remove('drop-zone--over');
                });
            });

            // Manejar el evento de soltar la imagen
            dropZone.addEventListener('drop', (e) => {
                e.preventDefault();
                dropZone.classList.remove('drop-zone--over');

                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    updateImagePreview(fileInput.files[0]);
                }
            });

            // Manejar el evento de seleccionar archivo manualmente
            fileInput.addEventListener('change', (e) => {
                if (fileInput.files.length) {
                    updateImagePreview(fileInput.files[0]);
                }
            });

            // Función para actualizar la vista previa de la imagen
            function updateImagePreview(file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.innerHTML = `<img src="${e.target.result}" class="img-thumbnail" alt="Vista previa de la imagen">`;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection