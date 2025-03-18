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


@endsection
