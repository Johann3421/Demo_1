{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<link rel="canonical" href="{{ url()->current() }}">

<head>
    <!-- Preconexión para recursos externos -->
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Google tag (gtag.js) con precarga -->
    <link rel="preload" href="https://www.googletagmanager.com/gtag/js?id=G-X4FWJY61GM" as="script">
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
    <title>@yield('title', 'SEKAITECH - Lo mejor en productos tecnológicos en Huánuco')</title>
    <meta name="description" content="@yield('meta-description', 'Descubre SEKAITECH, tu tienda de tecnología en Huánuco. Encuentra laptops, PCs, monitores y más al mejor precio. ¡Envíos a todo Perú!')">
    <meta name="keywords" content="@yield('keywords', 'productos, tienda online, ecommerce, ofertas, comprar online, envío rápido, productos de calidad, laptops, impresoras, PCs, puntos de venta')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="SEKAITECH">

    <!-- Open Graph / Facebook -->
    <meta property="og:title" content="@yield('og:title', 'SEKAITECH - Lo mejor en productos tecnológicos en Huánuco')">
    <meta property="og:description" content="@yield('og:description', 'Descubre SEKAI TECH, tu aliado en informática en Huánuco y Perú. Comprar computadoras, laptops, tarjetas de video y monitores de alta calidad es fácil con nuestra asesoría experta y tecnología de vanguardia.')">
    <meta property="og:image" content="@yield('og:image', asset('images/logo.png'))">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter:title', 'SEKAITECH - Lo mejor en productos tecnológicos en Huánuco')">
    <meta name="twitter:description" content="@yield('twitter:description', 'Descubre SEKAI TECH, tu aliado en informática en Huánuco y Perú. Comprar computadoras, laptops, tarjetas de video y monitores de alta calidad es fácil con nuestra asesoría experta y tecnología de vanguardia.')">
    <meta name="twitter:image" content="@yield('twitter:image', asset('images/logo.png'))">

    <!-- Favicon con preload -->
    <link rel="preload" href="{{ asset('images/LOGO-SEKAITECH-2 (1).ico') }}" as="image" type="image/x-icon">
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

    <!-- Inline Critical CSS -->
    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 9999;
        }
        .scroll-to-top.show {
            opacity: 1;
        }
        .scroll-to-top:hover {
            background-color: #0056b3;
        }
    </style>

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
            </div>
        </div>

        <div class="container custom-container d-flex justify-content-center">
            <main class="col-md-9 col-12">
                @yield('content')
            </main>
        </div>
        
        @include('components.proveedores')
    </div>

    @include('partials.footer')

    <!-- Defer non-critical JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    
    <!-- Inline scripts for critical functionality -->
    <script>
        // Cookies check
        (function checkCookies() {
            document.cookie = "test=1"; // Intenta establecer una cookie
            let cookiesEnabled = document.cookie.indexOf("test=") !== -1;

            if (!cookiesEnabled) {
                let warningDiv = document.createElement("div");
                warningDiv.innerHTML = "⚠️ Las cookies están deshabilitadas en tu navegador. Actívalas para una mejor experiencia.";
                warningDiv.style.position = "fixed";
                warningDiv.style.bottom = "0";
                warningDiv.style.left = "0";
                warningDiv.style.width = "100%";
                warningDiv.style.backgroundColor = "#f44336";
                warningDiv.style.color = "white";
                warningDiv.style.padding = "10px";
                warningDiv.style.textAlign = "center";
                warningDiv.style.fontSize = "16px";
                warningDiv.style.zIndex = "10000";
                
                document.body.appendChild(warningDiv);
            }
        })();

        // Scroll to top functionality
        document.addEventListener("DOMContentLoaded", function () {
            const scrollToTopButton = document.getElementById("scrollToTop");

            // Detectar el scroll para mostrar el botón
            window.addEventListener("scroll", function () {
                if (window.scrollY > 300) {
                    scrollToTopButton.classList.add("show");
                } else {
                    scrollToTopButton.classList.remove("show");
                }
            });

            // Evento de clic para volver al header
            scrollToTopButton.addEventListener("click", function () {
                window.scrollTo({
                    top: 0,
                    behavior: "smooth"
                });
            });
        });

        // Performance monitoring
        window.addEventListener('load', function() {
            setTimeout(function(){
                let timing = performance.timing;
                let loadTime = timing.loadEventEnd - timing.navigationStart;
                console.log('Page fully loaded in: '+loadTime+'ms');
                
                if (loadTime > 3000) {
                    console.warn('Load time is longer than 3 seconds');
                }
            }, 0);
        });
    </script>
    
    <div id="scrollToTop" class="scroll-to-top">
        <i class="fas fa-chevron-up"></i>
    </div>
</body>
</html>