@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Editar Especificación</h1>
    <form action="{{ route('panel.especificaciones.update', $especificacion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="campo" class="form-label">Campo:</label>
            <input type="text" name="campo" id="campo" class="form-control" value="{{ $especificacion->campo }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción:</label>
            <textarea name="descripcion" id="descripcion" class="form-control" required>{{ $especificacion->descripcion }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
