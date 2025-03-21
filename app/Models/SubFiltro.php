<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFiltro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'categoria_id'];

    // Relación con categorias
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    // Relación con opciones
    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'sub_filtro_id');
    }
    public function productos()
{
    return $this->belongsToMany(Producto::class, 'producto_subfiltro')
                ->withPivot('opcion_id'); // Si usas opciones
}
}