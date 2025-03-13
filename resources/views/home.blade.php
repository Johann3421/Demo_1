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

<section class="categories-section">
    <h2 class="section-title">Categorías Más Populares</h2>
    <div class="row mt-4">
        @foreach($categorias as $categoria)
            @php
                $totalProductos = rand(5, 50);
            @endphp
            <div class="col-md-4 mb-4">
                <a href="{{ route('products', ['categoria' => $categoria->nombre]) }}" class="text-decoration-none">
                    <div class="categoria-card shadow-lg" 
                         style="background: url('{{ asset('images/' . $categoria->imagen_url) }}') center/cover no-repeat; height: 250px;">
                        <div class="category-name">{{ $categoria->nombre }}</div>
                        <div class="overlay">Productos: {{ $totalProductos }}</div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</section>

<section class="offers-section">
    <h2 class="section-title">Ofertas y Descuentos Especiales</h2>
    <div class="sekai-banner">
        <img src="{{ asset('images/AUDIFONO.png') }}" alt="Promoción de Audífonos - SEKAITECH" class="img-fluid w-100">
    </div>
</section>

@include('partials.product-slider', ['productos' => \App\Models\Producto::inRandomOrder()->take(50)->get()])

<section class="brands-section">
    <h2 class="section-title">Las Mejores Marcas de Tecnología</h2>
    <div id="carouselProveedoresSekai" class="carousel slide sekai-carousel-container mt-3" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item sekai-carousel-item active">
                PROVEEDOR 1
            </div>
            <div class="carousel-item sekai-carousel-item">
                PROVEEDOR 2
            </div>
            <div class="carousel-item sekai-carousel-item">
                PROVEEDOR 3
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProveedoresSekai" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProveedoresSekai" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>
</section>

@endsection
