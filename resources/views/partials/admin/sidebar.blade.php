<!-- resources/views/partials/admin/sidebar.blade.php -->

<aside class="bg-light border-end shadow-lg" style="width: 250px; min-height: 100vh;">
    <div class="p-3">
        <!-- Logo o Nombre del Panel -->
        <div class="text-center mb-4">
            <a href="{{ route('panel.index') }}" class="text-decoration-none text-dark fw-bold">
                <h4 class="mb-0">Admin Panel</h4>
            </a>
        </div>

        <!-- Menú de Navegación -->
        <nav class="nav flex-column">
            <a href="{{ route('panel.index') }}" class="nav-link sidebar-link">
                <i class="fas fa-home me-2 text-primary animate-icon"></i> Inicio
            </a>
            <a href="{{ route('panel.productos') }}" class="nav-link sidebar-link">
                <i class="fas fa-box me-2 text-warning animate-icon"></i> Productos
            </a>
            <!-- Nueva opción para asignar opciones a productos -->
            <a href="{{ route('panel.productos.asignar_opciones') }}" class="nav-link sidebar-link">
                <i class="fas fa-check-circle me-2 text-success animate-icon"></i> Asignar Opciones
            </a>
            <a href="{{ route('panel.categorias') }}" class="nav-link sidebar-link">
                <i class="fas fa-tags me-2 text-success animate-icon"></i> Categorías
            </a>
            <a href="{{ route('panel.filtros') }}" class="nav-link sidebar-link">
                <i class="fas fa-layer-group me-2 text-info animate-icon"></i> Grupos
            </a>
            <a href="{{ route('panel.subfiltro') }}" class="nav-link sidebar-link">
                <i class="fas fa-sliders-h me-2 text-danger animate-icon"></i> Sub Filtros
            </a>
            <a href="{{ route('panel.banners') }}" class="nav-link sidebar-link">
                <i class="fas fa-image me-2 text-secondary animate-icon"></i> Banners
            </a>
            <a href="{{ route('panel.proveedores') }}" class="nav-link sidebar-link">
                <i class="fas fa-truck me-2 text-dark animate-icon"></i> Proveedores
            </a>
            <a href="{{ route('panel.configuracion') }}" class="nav-link sidebar-link">
                <i class="fas fa-cog me-2 text-primary animate-icon"></i> Configuración
            </a>
        </nav>
    </div>
</aside>
