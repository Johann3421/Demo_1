@extends('layouts.app', ['ocultarSlider' => true])

@section('content')
<div class="error-404">
    <h1>404 - Página no encontrada</h1>
    <p>Lo sentimos, la página que buscas no existe.</p>
    
    <!-- 🖼️ Imagen GIF -->
    <img src="{{ asset('images/error-404.gif') }}" alt="Error 404" class="error-gif">

    <a href="{{ url('/') }}" class="btn btn-primary">Volver al inicio</a>
</div>
@endsection

<style>
/* 🎨 Estilos para la página 404 */
.error-404 {
    text-align: center;
    padding: 50px;
}

.error-gif {
    width: 300px;
    max-width: 100%;
    margin: 20px auto;
    display: block;
}
</style>
