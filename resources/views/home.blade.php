@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="text-center">
    <span class="section-tag">MAS VENDIDOS</span>
    <h1 class="section-title">NUESTROS PRODUCTOS</h1>
</div>

<div class="sekai-banner-placeholder">ESPACIO PARA BANNER</div>

<div class="text-center">
    <span class="section-tag">SEKAITECH</span>
</div>

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


<!-- Sección del Banner -->
<div class="sekai-banner-placeholder">ESPACIO PARA BANNER</div>

<!-- Sección de Proveedores -->
<div class="text-center mt-5">
    <span class="section-tag">SEKAITECH</span>
</div>

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

@endsection
