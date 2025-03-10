@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('images/kenya1.png') }}" class="card-img-top" alt="Producto 1" loading="lazy">
                <div class="card-body">
                    <h5 class="card-title">Computadoras</h5>
                    <p class="card-text">Puedes ver la seccion de productos con la mejor calidad en Huanuco</p>
                    <a class="btn btn-primary" href="{{ route('products') }}">Ver Catalogo</a>
                </div>
            </div>
        </div>
    </div>
@endsection