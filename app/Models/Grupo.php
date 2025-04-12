<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    public $timestamps = false;
    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'categoria_id',
    ];

    /**
     * Obtener la categoría a la que pertenece el grupo.
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Obtener los subgrupos asociados a este grupo.
     */
    public function subgrupos()
    {
        return $this->hasMany(Subgrupo::class, 'grupo_id'); // Asegúrate de que 'grupo_id' sea la clave foránea correcta
    }
}
