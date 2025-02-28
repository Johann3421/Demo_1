@extends('layouts.app')

@section('title', 'Productos - Tienda Kenya')

@section('meta-description', 'Explora nuestros productos genéricos y exclusivos. Encuentra tarjetas de video, laptops, pantallas y productos únicos que solo encontrarás aquí.')

@section('content')
<h1 class="mb-4">Nuestros Productos</h1>
<div class="row">
    <!-- Productos Genéricos -->
    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 1]) }}">
                <img src="{{ asset('images/rtx.webp') }}" class="card-img-top" alt="Tarjeta de Video Genérica">
            </a>
            <div class="card-body">
                <h5 class="card-title">Tarjeta Grafica Msi Geforce Rtx 4070ti Super 16gb Gddr6x</h5>
                <p class="card-text">Tarjeta de video de alto rendimiento para gaming y diseño gráfico.</p>
                <p class="card-text"><strong>Precio: $299.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="1">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="1">❤️ Favorito</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 2]) }}">
                <img src="{{ asset('images/laptop.webp') }}" class="card-img-top" alt="Laptop Genérica">
            </a>
            <div class="card-body">
                <h5 class="card-title">Laptop Lenovo Intel Core I5 16gb 512gb Ssd Ideapad Slim 3i 12° Gen Fhd</h5>
                <p class="card-text">Laptop potente y ligera para trabajo y entretenimiento.</p>
                <p class="card-text"><strong>Precio: $799.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="2">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="2">❤️ Favorito</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 3]) }}">
                <img src="{{ asset('images/monitor.jfif') }}" class="card-img-top" alt="Pantalla Genérica">
            </a>
            <div class="card-body">
                <h5 class="card-title">Monitor plano 21.5" Teros TE-2127S Panel IPS, FHD (1920 x 1080), 100Hz, 1ms, entradas HDMI/VGA</h5>
                <p class="card-text">Pantalla Full HD de 24 pulgadas para una experiencia visual increíble.</p>
                <p class="card-text"><strong>Precio: $149.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="3">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="3">❤️ Favorito</button>
            </div>
        </div>
    </div>

    <!-- Productos Específicos -->
    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 2]) }}">
                <img src="{{ asset('images/laptop.webp') }}" class="card-img-top" alt="Producto Exclusivo 1">
            </a>
            <div class="card-body">
                <h5 class="card-title">Laptop Exclusiva KenyaPro X1</h5>
                <p class="card-text">Laptop exclusiva con procesador de última generación y diseño ultradelgado.</p>
                <p class="card-text"><strong>Precio: $1299.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="4">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="4">❤️ Favorito</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 1]) }}">
                <img src="{{ asset('images/rtx.webp') }}" class="card-img-top" alt="Producto Exclusivo 2">
            </a>
            <div class="card-body">
                <h5 class="card-title">Tarjeta de Video KenyaUltra RTX</h5>
                <p class="card-text">Tarjeta de video exclusiva con tecnología RTX para gaming extremo.</p>
                <p class="card-text"><strong>Precio: $899.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="5">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="5">❤️ Favorito</button>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card">
            <a href="{{ route('producto.detalles', ['id' => 3]) }}">
                <img src="{{ asset('images/monitor.jfif') }}" class="card-img-top" alt="Producto Exclusivo 3">
            </a>
            <div class="card-body">
                <h5 class="card-title">Pantalla KenyaView 4K</h5>
                <p class="card-text">Pantalla exclusiva 4K con colores vibrantes y diseño sin bordes.</p>
                <p class="card-text"><strong>Precio: $499.99</strong></p>
                <button class="btn btn-primary add-to-cart" data-id="6">Añadir al Carrito</button>
                <button class="btn btn-warning add-to-favorites" data-id="6">❤️ Favorito</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Simular tiempo de carga
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            document.querySelectorAll('.card').forEach(card => {
                card.style.opacity = '1';
            });
        }, 500); // 500ms de retraso
    });

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