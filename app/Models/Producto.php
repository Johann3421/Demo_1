<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'categoria', 'precio', 'stock'];

    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }
}
