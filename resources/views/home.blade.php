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

</style>
@endsection
