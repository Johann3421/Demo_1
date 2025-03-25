<?php

// app/Models/ImagenMedio.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImagenMedio extends Model
{
    protected $table = 'imagen_medio';
    protected $fillable = [
        'token',
        'nombre_original',
        'ruta',
        'mime_type',
        'size',
        'enlace',
        'texto_alternativo'
    ];

    // Obtener la URL completa de la imagen
    public function getUrlAttribute()
    {
        return asset($this->ruta . $this->token);
    }
}