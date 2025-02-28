{{-- resources/views/search-results.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Resultados de búsqueda para "{{ $query }}"</h1>
    @if($products->isEmpty())
        <p>No se encontraron productos.</p>
    @else
        <div class="product-list">
            @foreach($products as $product)
                <div class="product-item">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->description }}</p>
                    <p>Precio: {{ $product->price }}€</p>
                </div>
            @endforeach
        </div>
    @endif
@endsection