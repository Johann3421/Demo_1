<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subgrupo extends Model
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
        'grupo_id',
    ];

    /**
     * Obtener el grupo al que pertenece el subgrupo.
     */
    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }
    // app/Models/Subgrupo.php
public function productos()
{
    return $this->hasMany(Producto::class, 'subgrupo_id');
}
}
