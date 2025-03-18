<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['nombre', 'descripcion', 'imagen_url'];

    // Relación con Productos
    public function productos()
    {
        return $this->hasMany(Producto::class, 'categoria_id');
    }
    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'categoria_id'); // Asegúrate de que 'categoria_id' sea la clave foránea correcta
    }
}
