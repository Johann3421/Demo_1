@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="row">
        @foreach($categorias as $categoria)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/' . $categoria->imagen_url) }}" class="card-img-top" alt="{{ $categoria->nombre }}" loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title">{{ $categoria->nombre }}</h5>
                        <p class="card-text">{{ $categoria->descripcion }}</p>
                        <a class="btn btn-primary" href="{{ route('products') }}">Ver Catalogo</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
