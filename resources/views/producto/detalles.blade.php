@extends('layouts.app')

@section('title', $producto['nombre'] . ' - Tienda Kenya')

@section('meta-description', $producto['descripcion'])

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('images/' . $producto['imagen']) }}" class="img-fluid" alt="{{ $producto['nombre'] }}">
            </div>
            <div class="col-md-6">
                <h1>{{ $producto['nombre'] }}</h1>
                <p class="lead">{{ $producto['descripcion'] }}</p>
                <p><strong>Precio: {{ $producto['precio'] }}</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="{{ $id }}">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="{{ $id }}">❤️ Favorito</button>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <h2>Detalles Técnicos</h2>
                <p>{{ $producto['detalles'] }}</p>
            </div>
        </div>
    </div>
@endsection