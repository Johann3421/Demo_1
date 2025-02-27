@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/kenya1.png') }}" class="card-img-top" alt="Producto 1" loading="lazy">
                <div class="card-body">
                    <h5 class="card-title">Producto 1</h5>
                    <p class="card-text">Descripción breve del producto.</p>
                    <button class="btn btn-primary add-to-cart" data-id="1">Añadir al Carrito</button>
                </div>
            </div>
        </div>
    </div>
@endsection
