@extends('layouts.app')

@section('title', 'Inicio - SEKAITECH | Tecnología y Ofertas en Huánuco')

@section('meta_description', 'Descubre las mejores categorías de tecnología en SEKAITECH, Huánuco. Encuentra laptops, computadoras, tarjetas de video y más al mejor precio.')

@section('meta_keywords', 'productos tecnológicos, laptops, computadoras, tarjetas de video, monitores, SEKAITECH, Huánuco, tecnología, ofertas')

@section('og:title', 'Inicio - SEKAITECH | Tecnología y Ofertas en Huánuco')
@section('og:description', 'Descubre las mejores categorías de tecnología en SEKAITECH, Huánuco. Encuentra laptops, computadoras, tarjetas de video y más al mejor precio.')
@section('og:image', asset('images/logo.png'))
@section('og:url', url()->current())

@section('twitter:title', 'Inicio - SEKAITECH | Tecnología y Ofertas en Huánuco')
@section('twitter:description', 'Descubre las mejores categorías de tecnología en SEKAITECH, Huánuco. Encuentra laptops, computadoras, tarjetas de video y más al mejor precio.')
@section('twitter:image', asset('images/logo.png'))

@section('content')

<div class="text-center">
    <h1 class="main-title">Explora Nuestras Categorías de Tecnología en SEKAITECH</h1>
</div>

<section class="categorias-container">
    <!-- Contenedor del título 100% centrado sin afectar otros estilos -->
    <div class="categorias-titulo-container">
        <h2 class="categorias-titulo">CATEGORÍAS</h2>
    </div>

    <!-- Grid de Categorías -->
    <div class="categorias-grid">
        @foreach($categorias as $categoria)
            <div class="categoria-item">
                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="categoria-link">
                    <div class="categoria-card">
                        <img src="{{ asset('images/' . $categoria->imagen_url) }}" alt="{{ $categoria->nombre }}" class="categoria-imagen">
                        <div class="categoria-nombre">{{ strtoupper($categoria->nombre) }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>


<section class="offers-section">
    <div class="sekai-banner">
        @php
            $banner = App\Models\ImagenMedio::latest()->first();

            if($banner) {
                $bannerUrl = $banner->url;
                $bannerAlt = $banner->texto_alternativo ?? 'Promoción Especial - SEKAITECH';
        @endphp
                <img src="{{ $bannerUrl }}" alt="{{ $bannerAlt }}" class="img-fluid w-100"
                     onerror="this.onerror=null;this.src='{{ asset('images/AUDIFONO.png') }}'">
        @php
            } else {
                // Mostrar imagen por defecto si no hay banner configurado
        @endphp
                <img src="{{ asset('images/AUDIFONO.png') }}" alt="Promoción por defecto - SEKAITECH" class="img-fluid w-100">
        @php
            }
        @endphp
    </div>
</section>

@include('partials.product-slider', ['productos' => \App\Models\Producto::inRandomOrder()->take(50)->get()])

<style>
/* Estilo para el título principal h1 */
.main-title {
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 2.5rem;
    line-height: 1.2;
    color: #2d3748;
    margin: 2rem 0;
    position: relative;
    display: inline-block;
    padding-bottom: 1rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
}

.main-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #4f46e5, #10b981);
    border-radius: 2px;
}

/* Estilo para el subtítulo h2 */
.categorias-titulo {
    font-family: 'Inter', sans-serif;
    font-weight: 800;
    font-size: 1.8rem;
    letter-spacing: 0.05em;
    color: #1e293b;
    text-transform: uppercase;
    margin: 1.5rem 0;
    position: relative;
    display: inline-block;
    padding: 0 1.5rem;
}

.categorias-titulo::before,
.categorias-titulo::after {
    content: '';
    position: absolute;
    top: 50%;
    width: 40px;
    height: 2px;
    background: linear-gradient(90deg, transparent, #64748b);
}

.categorias-titulo::before {
    left: -20px;
}

.categorias-titulo::after {
    right: -20px;
    background: linear-gradient(90deg, #64748b, transparent);
}

/* Contenedor para centrar perfectamente */
.categorias-titulo-container {
    text-align: center;
    width: 100%;
    position: relative;
    margin: 2rem 0;
}

/* Efectos hover para interactividad */
.main-title:hover {
    color: #4f46e5;
    transition: color 0.3s ease;
}

/* Versión responsive */
@media (max-width: 1024px) {
    .main-title {
        font-size: 2.2rem;
    }

    .categorias-titulo {
        font-size: 1.6rem;
    }
}

@media (max-width: 768px) {
    .main-title {
        font-size: 1.8rem;
        padding-bottom: 0.8rem;
    }

    .main-title::after {
        width: 60px;
        height: 3px;
    }

    .categorias-titulo {
        font-size: 1.4rem;
        padding: 0 1rem;
    }

    .categorias-titulo::before,
    .categorias-titulo::after {
        width: 30px;
    }
}

@media (max-width: 480px) {
    .main-title {
        font-size: 1.5rem;
        margin: 1.5rem 0;
    }

    .categorias-titulo {
        font-size: 1.2rem;
        margin: 1rem 0;
    }
}

/* Animaciones sutiles */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.main-title {
    animation: fadeInUp 0.6s ease-out forwards;
}

.categorias-titulo {
    animation: fadeInUp 0.6s ease-out 0.2s forwards;
    opacity: 0;
}
</style>
@endsection
