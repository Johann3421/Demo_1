{{-- resources/views/partials/aside.blade.php --}}
<div class="sidebar-container">
    <div class="left-sidebar" id="left-sidebar">
        <h2>Categorias</h2>
        <div class="panel-group category-products" id="accordian">
            <!-- Categorías -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#" class="tech-link">
                            <i class="fas fa-microchip tech-icon"></i>
                            <span class="tech-text animate__animated animate__fadeIn">ALMACENAMIENTO</span>
                        </a>
                    </h4>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="#" class="tech-link">
                            <i class="fas fa-microchip tech-icon"></i>
                            <span class="tech-text animate__animated animate__fadeIn">CAMARA DE SEGURIDAD Y ACCESOS</span>
                        </a>
                    </h4>
                </div>
            </div>
            <!-- Repite el resto de las categorías aquí -->
        </div>
    </div>
    <div class="sidebar-toggle" id="sidebar-toggle">
        <i class="fas fa-chevron-right"></i>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('left-sidebar');
        const toggleButton = document.getElementById('sidebar-toggle');

        toggleButton.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            toggleButton.classList.toggle('active');
        });
    });
</script>