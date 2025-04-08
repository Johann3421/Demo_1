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
<link rel="stylesheet" href="{{ asset('css/home.css') }}">

<div class="text-center">
    <h1 class="main-title">Explora Nuestras Categorías</h1>
</div>

<section class="sekai-categorias-container">

    <div class="sekai-categorias-titulo-container"></div>

    <!-- Grid desktop/tablet -->
    <div class="sekai-categorias-grid">
        @forelse($categorias as $categoria)
            <div class="sekai-categoria-item">
                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="sekai-categoria-link">
                    <div class="sekai-categoria-card">
                        <div class="sekai-categoria-imagen-container">
                            <img src="{{ asset('images/' . $categoria->imagen_url) }}"
                                 alt="{{ $categoria->nombre }}"
                                 class="sekai-categoria-imagen"
                                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}'">
                        </div>
                        <div class="sekai-categoria-contenido">
                            <h3 class="sekai-categoria-nombre">{{ strtoupper($categoria->nombre) }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @empty
            <p class="text-center">No hay categorías disponibles.</p>
        @endforelse
    </div>

    <!-- Carrusel mobile -->
    <div class="sekai-mobile-carrusel">
        @foreach($categorias as $categoria)
            <div class="sekai-mobile-categoria-slide">
                <a href="{{ route('products.by.categoria', ['categoria' => $categoria->nombre]) }}" class="sekai-mobile-categoria-link">
                    <div class="sekai-mobile-categoria-card">
                        <div class="sekai-mobile-imagen-container">
                            <img src="{{ asset('images/' . $categoria->imagen_url) }}"
                                 alt="{{ $categoria->nombre }}"
                                 class="sekai-mobile-categoria-imagen"
                                 onerror="this.onerror=null;this.src='{{ asset('images/placeholder.jpg') }}'">
                        </div>
                        <div class="sekai-mobile-categoria-contenido">
                            <h3 class="sekai-mobile-categoria-nombre">{{ strtoupper($categoria->nombre) }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

<section class="offers-section">
    <div class="sekai-banner">
        @php $banner = App\Models\ImagenMedio::latest()->first(); @endphp

        <img src="{{ $banner->url ?? asset('images/AUDIFONO.png') }}"
             alt="{{ $banner->texto_alternativo ?? 'Promoción Especial - SEKAITECH' }}"
             class="img-fluid w-100"
             onerror="this.onerror=null;this.src='{{ asset('images/AUDIFONO.png') }}'">
    </div>
</section>


@include('partials.product-slider', ['productos' => \App\Models\Producto::inRandomOrder()->take(50)->get()])
<script src="{{ asset('js/home.js') }}"></script>

@endsection
