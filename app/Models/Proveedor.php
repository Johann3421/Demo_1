<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla manualmente
    protected $table = 'proveedores';

    protected $fillable = [
        'nombre',
        'imagen_url',
        'url',
        'alt_text',
    ];
}