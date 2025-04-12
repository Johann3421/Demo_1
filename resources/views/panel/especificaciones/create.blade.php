@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Crear Especificación para {{ $producto->nombre }}</h1>
    <!-- resources/views/panel/especificaciones/create.blade.php -->
<form action="{{ route('panel.especificaciones.store', $producto->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="campo" class="form-label">Campo:</label>
        <input type="text" name="campo" id="campo" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción:</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
</div>
@endsection
