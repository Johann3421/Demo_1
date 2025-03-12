{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X4FWJY61GM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-X4FWJY61GM');
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SEKAITECH - Lo mejor en productos tecnológicos en Huánuco</title>
    <meta name="description" content="Descubre SEKAITECH, tu aliado en informática en Huánuco y Perú. Comprar computadoras, laptops, tarjetas de video y monitores de alta calidad es fácil con nuestra asesoría experta y tecnología de vanguardia.">
    <meta name="keywords" content="productos, tienda online, ecommerce, ofertas, comprar online, envío rápido, productos de calidad, laptops, impresoras, PCs, puntos de venta">
    <meta name="robots" content="index, follow">
    <meta name="author" content="SEKAITECH">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="SEKAITECH - Lo mejor en productos tecnológicos en Huánuco">
    <meta property="og:description" content="Descubre SEKAI TECH, tu aliado en informática en Huánuco y Perú. Comprar computadoras, laptops, tarjetas de video y monitores de alta calidad es fácil con nuestra asesoría experta y tecnología de vanguardia.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SEKAITECH - Lo mejor en productos tecnológicos en Huánuco">
    <meta name="twitter:description" content="Descubre SEKAI TECH, tu aliado en informática en Huánuco y Perú. Comprar computadoras, laptops, tarjetas de video y monitores de alta calidad es fácil con nuestra asesoría experta y tecnología de vanguardia.">
    <meta name="twitter:image" content="{{ asset('images/logo.png') }}">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('images/LOGO-SEKAITECH-2 (1).ico') }}" type="image/x-icon">

    <!-- Preload critical resources -->
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Load non-critical CSS asynchronously -->
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </noscript>

    <!-- Defer non-critical JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MVLCVXPL');
    </script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVLCVXPL" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    @include('partials.header')

    @include('partials.subheader')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(!isset($ocultarSlider) || !$ocultarSlider)
                @include('partials.slider')
                @endif
                <!-- Asegura que el slider no se vea afectado -->
            </div>
        </div>

        <div class="container custom-container d-flex justify-content-center">
            <main class="col-md-9 col-12">
                @yield('content')
            </main>
        </div>


    </div>

    @include('partials.footer') <!-- Ahora siempre se mostrará correctamente -->
</body>

</html>