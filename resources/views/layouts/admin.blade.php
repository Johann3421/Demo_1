<!-- resources/views/layouts/admin.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
        <!-- En el head -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Antes de cerrar el body -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <!-- Header -->
    @include('partials.admin.header')

    <div class="d-flex">
        <!-- Sidebar -->
        @include('partials.admin.sidebar')

        <!-- Contenido principal -->
        <main class="flex-grow-1 p-4">
            @yield('content')
        </main>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Scripts personalizados (opcional) -->
</body>
</html>
