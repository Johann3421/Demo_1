@extends('layouts.app')

@section('title', 'Favoritos')

@section('content')
    <h1 class="mb-4">Productos Favoritos</h1>
    <div class="row">
        @forelse ($favorites as $id)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/producto'.$id.'.png') }}" class="card-img-top" alt="Producto {{ $id }}">
                    <div class="card-body">
                        <h5 class="card-title">Producto {{ $id }}</h5>
                        <p class="card-text">Uno de tus productos favoritos.</p>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No tienes productos favoritos aún.</p>
        @endforelse
    </div>
@endsection
