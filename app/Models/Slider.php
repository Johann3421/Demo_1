<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = ['imagen_url', 'enlace', 'status'];

    // Valor por defecto para el campo 'status'
    protected $attributes = [
        'status' => 1, // 1 = activo, 0 = inactivo
    ];
}