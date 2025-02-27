@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <h1 class="mb-4">Carrito de Compras</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cart as $id => $quantity)
                <tr>
                    <td>Producto {{ $id }}</td>
                    <td>{{ $quantity }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No hay productos en el carrito</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
