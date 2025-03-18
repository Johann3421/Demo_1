<!-- resources/views/partials/admin/header.blade.php -->

<header class="bg-dark text-white p-3 shadow">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <!-- Logo o nombre del panel -->
            <div class="d-flex align-items-center">
                <a href="{{ route('panel.index') }}" class="text-white text-decoration-none">
                    <h3 class="mb-0">Panel de Administración</h3>
                </a>
            </div>

            <!-- Menú de usuario -->
            <div class="d-flex align-items-center">
                <!-- Notificaciones (opcional) -->
                <div class="dropdown me-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-bell"></i>
                        <span class="badge bg-danger">3</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Notificación 1</a></li>
                        <li><a class="dropdown-item" href="#">Notificación 2</a></li>
                        <li><a class="dropdown-item" href="#">Notificación 3</a></li>
                    </ul>
                </div>

                <!-- Avatar y nombre de usuario -->
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><a class="dropdown-item" href="#">Configuración</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>