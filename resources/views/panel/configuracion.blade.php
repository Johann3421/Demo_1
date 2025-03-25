@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Configuración del Sistema</h2>

    <div class="row">
        <!-- Tarjeta: Precio del Dólar -->
        <div class="col-md-4 mb-4">
            <div class="config-card">
                <div class="config-icon bg-success">
                    <i class="fas fa-dollar-sign"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Precio del Dólar</h5>
                    <p class="text-muted">Cambia el precio del dólar en tiempo real.</p>
                    <h3 id="precioDolar">S/ {{ $precio_dolar }}</h3>
                    <button id="actualizarDolar" class="btn btn-primary">Actualizar</button>
                    <div id="dolarMessage" class="mt-2"></div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Configuración de Imagen Medio -->
        <div class="col-md-4 mb-4">
            <div class="config-card">
                <div class="config-icon bg-warning">
                    <i class="fas fa-image"></i>
                </div>
                <div>
                    <h5 class="fw-bold">Imagen de Anuncio Medio</h5>
                    <p class="text-muted">Cambia la imagen y el enlace de la parte media.</p>
                    <button id="cambiarBannerBtn" class="btn btn-primary mt-2">
                        <i class="fas fa-upload me-2"></i>Cambiar Banner
                    </button>
                    <div id="bannerMessage" class="mt-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar banner -->
<div class="modal fade" id="bannerModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Configurar Banner Promocional</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="bannerForm" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="bannerImage" class="form-label">Imagen del Banner</label>
                        <input type="file" class="form-control" id="bannerImage" name="banner_image" accept="image/*" required>
                        <div class="form-text">Recomendado: 1200x400px, formato JPG/PNG (Máx. 2MB)</div>
                    </div>
                    <div class="mb-3">
                        <label for="bannerLink" class="form-label">Enlace de Destino (Opcional)</label>
                        <input type="url" class="form-control" id="bannerLink" name="banner_link" placeholder="https://...">
                    </div>
                    <div class="mb-3">
                        <label for="bannerAlt" class="form-label">Texto Alternativo</label>
                        <input type="text" class="form-control" id="bannerAlt" name="banner_alt" placeholder="Descripción de la imagen">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Previsualización del Banner -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title">Vista Previa del Banner</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-0">
                <img id="bannerPreview" src="" alt="Vista previa" class="img-fluid w-100">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="confirmUpload" class="btn btn-primary">Confirmar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Elementos del DOM
    const bannerModal = new bootstrap.Modal(document.getElementById('bannerModal'));
    const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
    const bannerForm = document.getElementById('bannerForm');
    const bannerImageInput = document.getElementById('bannerImage');
    const bannerPreview = document.getElementById('bannerPreview');
    const cambiarBannerBtn = document.getElementById('cambiarBannerBtn');
    const confirmUploadBtn = document.getElementById('confirmUpload');
    const bannerMessage = document.getElementById('bannerMessage');

    // Tipos de archivo permitidos
    const validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
    const maxFileSize = 2 * 1024 * 1024; // 2MB

    // Mostrar modal de configuración
    cambiarBannerBtn.addEventListener('click', () => {
        resetBannerForm();
        bannerModal.show();
    });

    // Previsualizar imagen seleccionada
    bannerImageInput.addEventListener('change', handleImageSelection);

    // Confirmar cambios del banner
    confirmUploadBtn.addEventListener('click', uploadBanner);

    // Cerrar modales al hacer clic fuera
    document.addEventListener('click', handleModalBackdropClick);

    // Función para resetear el formulario
    function resetBannerForm() {
        bannerForm.reset();
        clearBannerMessages();
        bannerPreview.src = '';
    }

    // Función para manejar la selección de imagen
    function handleImageSelection(e) {
        const file = e.target.files[0];
        
        if (!file) return;

        // Validaciones
        if (!validImageTypes.includes(file.type)) {
            showBannerError('Formato de imagen no válido. Use JPG, PNG o GIF.');
            return;
        }

        if (file.size > maxFileSize) {
            showBannerError('La imagen es demasiado grande (máximo 2MB).');
            return;
        }

        // Previsualización
        const reader = new FileReader();
        reader.onload = (e) => {
            bannerPreview.src = e.target.result;
            previewModal.show();
        }
        reader.readAsDataURL(file);
    }

    // Función para subir el banner
    function uploadBanner() {
        const submitBtn = this;
        toggleUploadButton(submitBtn, true);
        
        previewModal.hide();
        bannerModal.hide();
        
        const formData = new FormData(bannerForm);
        
        fetch("{{ route('guardar.banner') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        })
        .then(handleResponse)
        .then(handleSuccess)
        .catch(handleError)
        .finally(() => toggleUploadButton(submitBtn, false));
    }

    // Función para manejar la respuesta
    function handleResponse(response) {
        if (!response.ok) {
            return response.json().then(err => {
                throw new Error(err.message || 'Error en el servidor');
            });
        }
        return response.json();
    }

    // Función para manejar éxito
    function handleSuccess(data) {
        if (data.success) {
            showBannerSuccess(data.message);
            updateBannersOnPage(data.banner_url);
        } else {
            throw new Error(data.message || 'Error al guardar el banner');
        }
    }

    // Función para manejar errores
    function handleError(error) {
        console.error('Error:', error);
        showBannerError(error.message || 'Error desconocido al guardar el banner');
    }

    // Función para actualizar banners en la página
    function updateBannersOnPage(bannerUrl) {
        if (bannerUrl) {
            const timestamp = new Date().getTime();
            document.querySelectorAll('.sekai-banner img').forEach(banner => {
                banner.src = `${bannerUrl}?t=${timestamp}`;
            });
        }
    }

    // Función para manejar clic fuera del modal
    function handleModalBackdropClick(event) {
        if (event.target === bannerModal._element) {
            bannerModal.hide();
        }
        if (event.target === previewModal._element) {
            previewModal.hide();
        }
    }

    // Función para mostrar mensaje de error
    function showBannerError(message) {
        bannerImageInput.value = '';
        bannerMessage.innerHTML = createAlertMessage(message, 'danger');
    }

    // Función para mostrar mensaje de éxito
    function showBannerSuccess(message) {
        bannerMessage.innerHTML = createAlertMessage(message, 'success');
        
        // Cerrar automáticamente después de 5 segundos
        setTimeout(() => {
            const alert = bannerMessage.querySelector('.alert');
            if (alert) {
                new bootstrap.Alert(alert).close();
            }
        }, 5000);
    }

    // Función para limpiar mensajes
    function clearBannerMessages() {
        bannerMessage.innerHTML = '';
    }

    // Función para crear mensajes de alerta
    function createAlertMessage(message, type) {
        const icon = type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle';
        return `
            <div class="alert alert-${type} alert-dismissible fade show">
                <i class="fas ${icon} me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
    }

    // Función para alternar estado del botón
    function toggleUploadButton(button, isLoading) {
        button.disabled = isLoading;
        button.innerHTML = isLoading 
            ? '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...'
            : 'Confirmar Cambios';
    }
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const btnActualizar = document.getElementById('actualizarDolar');
    const precioDolarElement = document.getElementById('precioDolar');
    const messageElement = document.getElementById('dolarMessage');

    btnActualizar.addEventListener('click', function() {
        // Mostrar estado de carga
        btnActualizar.disabled = true;
        btnActualizar.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Actualizando...';
        messageElement.textContent = '';
        messageElement.className = 'mt-2';

        fetch("{{ route('actualizar.dolar') }}", {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error en la red');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                precioDolarElement.textContent = "S/ " + data.precio;
                messageElement.textContent = 'Precio actualizado correctamente';
                messageElement.classList.add('text-success');
            } else {
                throw new Error(data.message || 'Error al obtener el precio');
            }
        })
        .catch(error => {
            console.error("Error:", error);
            messageElement.textContent = error.message;
            messageElement.classList.add('text-danger');
        })
        .finally(() => {
            btnActualizar.disabled = false;
            btnActualizar.textContent = 'Actualizar';
        });
    });
});
</script>

<style>
.config-card {
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    display: flex;
    gap: 15px;
    align-items: center;
    height: 100%;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.config-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 25px rgba(0,0,0,0.12);
}

.config-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.8rem;
    flex-shrink: 0;
}

#bannerPreview {
    max-height: 80vh;
    object-fit: contain;
}

.modal-content {
    border: none;
    border-radius: 12px;
    overflow: hidden;
}

.modal-header {
    border-bottom: none;
    padding: 1.5rem;
}

.modal-body {
    padding: 2rem;
}
</style>
@endsection