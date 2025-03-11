@foreach($productos as $producto)
<div class="product-card-specific text-center">
    <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}">
        <img src="{{ asset('images/' . $producto->imagen_url) }}" class="product-image-specific" alt="{{ $producto->nombre }}" loading="lazy">
    </a>
    <div class="product-body-specific">
        <h2 class="product-title-specific">{{ $producto->nombre }}</h2>
        <p class="product-text-specific">{{ $producto->descripcion }}</p>
        <div class="product-price-specific">
            <span class="price-usd">${{ number_format($producto->precio_dolares, 2) }}</span>
            <span class="price-pen">S/. {{ number_format($producto->precio_soles, 2) }}</span>
        </div>
        <a href="{{ route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]) }}" class="btn btn-primary">Ver Detalles</a>
    </div>
</div>
@endforeach
