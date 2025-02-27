@extends('layouts.app')

@section('title', $producto['nombre'] . ' - Tienda Kenya')

@section('meta-description', $producto['descripcion'])

@section('content')
    <div class="container">
        <div class="row">
            <!-- Galería de Imágenes -->
            <div class="col-md-6">
                <div class="mb-4">
                    <img src="{{ asset('images/' . $producto['imagen']) }}" class="img-fluid" alt="{{ $producto['nombre'] }}">
                </div>
                <div class="row">
                    <div class="col-4">
                        <img src="{{ asset('images/' . $producto['imagen']) }}" class="img-fluid mb-2" alt="Miniatura 1">
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('images/' . $producto['imagen']) }}" class="img-fluid mb-2" alt="Miniatura 2">
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('images/' . $producto['imagen']) }}" class="img-fluid mb-2" alt="Miniatura 3">
                    </div>
                </div>
            </div>

            <!-- Detalles del Producto -->
            <div class="col-md-6">
                <h1>{{ $producto['nombre'] }}</h1>
                <p class="lead">{{ $producto['descripcion'] }}</p>
                <p><strong>Precio: {{ $producto['precio'] }}</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="{{ $id }}">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="{{ $id }}">❤️ Favorito</button>

                <!-- Especificaciones Técnicas -->
                <div class="detalles-tecnicos mt-4">
                    <h2>Especificaciones Técnicas</h2>
                    <ul>
                        <li><strong>Marca:</strong> {{ $producto['marca'] ?? 'N/A' }}</li>
                        <li><strong>Modelo:</strong> {{ $producto['modelo'] ?? 'N/A' }}</li>
                        <li><strong>Procesador:</strong> {{ $producto['procesador'] ?? 'N/A' }}</li>
                        <li><strong>Memoria RAM:</strong> {{ $producto['ram'] ?? 'N/A' }}</li>
                        <li><strong>Almacenamiento:</strong> {{ $producto['almacenamiento'] ?? 'N/A' }}</li>
                        <li><strong>Pantalla:</strong> {{ $producto['pantalla'] ?? 'N/A' }}</li>
                        <li><strong>Gráficos:</strong> {{ $producto['graficos'] ?? 'N/A' }}</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Reseñas de Usuarios -->
        <div class="reseñas mt-5">
            <h2>Reseñas de Usuarios</h2>
            <div class="reseña">
                <h3>Juan Pérez</h3>
                <p>¡Excelente producto! Lo recomiendo totalmente.</p>
            </div>
            <div class="reseña">
                <h3>María Gómez</h3>
                <p>Muy buena calidad, cumple con todas mis expectativas.</p>
            </div>
        </div>
    </div>

    <script>
        // Funcionalidad de añadir al carrito y favoritos
        document.querySelectorAll('.add-to-cart').forEach(button => {
            button.addEventListener('click', function() {
                fetch("{{ route('cart.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id: this.dataset.id })
                }).then(response => response.json())
                  .then(data => alert('Producto añadido al carrito'));
            });
        });

        document.querySelectorAll('.add-to-favorites').forEach(button => {
            button.addEventListener('click', function() {
                fetch("{{ route('favorites.add') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ id: this.dataset.id })
                }).then(response => response.json())
                  .then(data => alert('Producto añadido a favoritos'));
            });
        });
    </script>
@endsection