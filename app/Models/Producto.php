<?php

namespace App\Models;

use App\Models\Scopes\VisibleScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'caracteristicas',
        'precio_dolares',
        'precio_soles',
        'imagen_url',
        'marca',
        'modelo',
        'procesador',
        'ram',
        'almacenamiento',
        'pantalla',
        'graficos',
        'stock',
        'descuento',
        'categoria_id',
        'grupo_id', // Asegúrate de que esté incluido
        'subgrupo_id', // Asegúrate de que esté incluido
        'visible',
        'sku',
    ];
    protected static function boot()
{
    parent::boot();

    static::creating(function ($producto) {
        if (empty($producto->sku)) {
            $producto->sku = self::generateUniqueSku();
        }
    });
}

public static function generateUniqueSku($attempts = 0)
{
    $sku = 'SKU-' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

    if (self::where('sku', $sku)->exists()) {
        if ($attempts >= 10) {
            return 'SKU-' . str_pad(time() % 1000000, 6, '0', STR_PAD_LEFT);
        }
        return self::generateUniqueSku($attempts + 1);
    }

    return $sku;
}

    public $timestamps = false;

    // Relación con Caracteristicas
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }

    // Relación con Categoría
    // app/Models/Producto.php
public function categoria()
{
    return $this->belongsTo(Categoria::class);
}

public function grupo()
{
    return $this->belongsTo(Grupo::class);
}

public function subgrupo()
{
    return $this->belongsTo(Subgrupo::class);
}
public function subFiltros()
    {
        return $this->belongsToMany(SubFiltro::class, 'producto_subfiltro');
    }
    public function opciones()
{
    return $this->belongsToMany(Opcion::class, 'producto_opcion');
}

protected static function booted()
    {
        static::addGlobalScope(new VisibleScope);
    }
    public function especificaciones()
{
    return $this->hasMany(Especificacion::class);
}
}
