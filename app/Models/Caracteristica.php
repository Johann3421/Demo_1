<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caracteristica extends Model
{
    use HasFactory;

    protected $fillable = ['producto_id', 'nombre', 'valor'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
