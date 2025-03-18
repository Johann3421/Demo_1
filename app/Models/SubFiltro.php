<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubFiltro extends Model
{
    use HasFactory;

    protected $fillable = ['nombre'];

    public function opciones()
    {
        return $this->hasMany(Opcion::class, 'sub_filtro_id');
    }
}