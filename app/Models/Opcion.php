<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opcion extends Model
{
    use HasFactory;

    protected $table = 'opciones'; // Define el nombre correcto de la tabla

    protected $fillable = ['nombre', 'sub_filtro_id'];

    public function subFiltro()
    {
        return $this->belongsTo(SubFiltro::class, 'sub_filtro_id');
    }
}
