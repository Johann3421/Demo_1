{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<link rel="canonical" href="{{ url()->current() }}">

<head>
    <!-- Preconexiones a dominios externos -->
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>

    <!-- Preload de recursos críticos externos -->
    <link rel="preload" href="https://www.googletagmanager.com/gtag/js?id=G-X4FWJY61GM" as="script">
    <link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="{{ asset('css/style.css') }}" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">

    <!-- Favicon optimizado -->
    <link rel="preload" href="{{ asset('images/icono_circulo.png') }}" as="image" type="image/x-icon" fetchpriority="high">
    <link rel="icon" href="{{ asset('images/icono_circulo.png') }}" type="image/x-icon">

    <!-- Carga de estilos no críticos si JS está deshabilitado -->
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    </noscript>

    <!-- Meta SEO y responsive -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SEKAITECH - Lo mejor en productos tecnológicos en Huánuco')</title>
    <meta name="description" content="@yield('meta-description', 'Descubre SEKAITECH, tu tienda de tecnología en Huánuco. Encuentra laptops, PCs, monitores y más al mejor precio. ¡Envíos a todo Perú!')">
    <meta name="keywords" content="@yield('keywords', 'productos, tienda online, ecommerce, ofertas, comprar online, envío rápido, productos de calidad, laptops, impresoras, PCs, puntos de venta')">
    <meta name="robots" content="index, follow">
    <meta name="author" content="SEKAITECH">

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

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-X4FWJY61GM"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){ dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'G-X4FWJY61GM');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){
            w[l]=w[l]||[];
            w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});
            var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),
                dl=l!='dataLayer'?'&l='+l:'';
            j.async=true;
            j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;
            f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-MVLCVXPL');
    </script>
</head>


<body>
    <!-- Google Tag Manager (noscript) optimizado con lazy -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MVLCVXPL"
                height="0"
                width="0"
                style="display:none;visibility:hidden"
                loading="lazy"
                title="Google Tag Manager"
                aria-hidden="true"></iframe>
    </noscript>

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
            <main class="col-md-9 col-12" role="main">
                @yield('content')
            </main>
        </div>

        @include('components.proveedores')
    </div>

    @include('partials.footer')

    <!-- JS deferido -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Scripts críticos inline -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const scrollBtn = document.getElementById("scrollToTop");

            const toggleScrollButton = () => {
                scrollBtn.classList.toggle("show", window.scrollY > 300);
            };

            const scrollToTop = (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: "smooth" });
            };

            window.addEventListener("scroll", toggleScrollButton);
            scrollBtn.querySelector('a').addEventListener("click", scrollToTop);
        });

        window.addEventListener('load', () => {
            setTimeout(() => {
                const { loadEventEnd, navigationStart } = performance.timing;
                const loadTime = loadEventEnd - navigationStart;

                console.log(`Page fully loaded in: ${loadTime}ms`);
                if (loadTime > 3000) {
                    console.warn('Load time is longer than 3 seconds');
                }
            }, 0);
        });
    </script>

    <!-- Botones flotantes optimizados -->
    <div class="floating-buttons-container">
        <!-- WhatsApp -->
        <div id="sekai-whatsapp-float" class="floating-button whatsapp-button">
            <a href="https://wa.me/51933573985?text=Quisiera%20contactarme%20con%20un%20Asesor"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="Contactar por WhatsApp"
               class="floating-button-link">
                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                <span class="floating-tooltip">¡Contáctanos!</span>
                <span class="floating-badge" role="status">En línea</span>
            </a>
        </div>

        <!-- Scroll to Top -->
        <div id="scrollToTop" class="floating-button scroll-top-button" aria-hidden="true">
            <a href="#" aria-label="Volver arriba" class="floating-button-link">
                <i class="fas fa-chevron-up" aria-hidden="true"></i>
                <span class="floating-tooltip">Volver arriba</span>
            </a>
        </div>
    </div>
</body>
</html>
