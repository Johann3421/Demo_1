{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Tienda')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="description" content="Explora nuestra selección de productos de alta calidad y encuentra lo que necesitas al mejor precio. Envíos rápidos y seguros en toda España.">
    <meta name="keywords" content="productos, tienda online, ecommerce, ofertas, comprar online, envío rápido, productos de calidad">
    <meta name="robots" content="index, follow">
    <link rel="icon" href="{{ asset('images/logo2.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    @include('partials.header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @include('partials.slider') <!-- Asegura que el slider no se vea afectado -->
            </div>
        </div>

        <div class="row content-wrapper">
            <aside class="col-md-3 d-none d-md-block left-sidebar">
                @include('partials.aside')
            </aside>
            <main class="col-md-9 col-12">
                @yield('content')
            </main>
        </div>
    </div>

    @include('partials.footer') <!-- Ahora siempre se mostrará correctamente -->
</body>


</html>