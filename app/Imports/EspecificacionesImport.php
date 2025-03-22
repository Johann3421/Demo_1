<?php

namespace App\Imports;

use App\Models\Especificacion;
use Maatwebsite\Excel\Concerns\ToModel;

class EspecificacionesImport implements ToModel
{
    protected $producto_id;

    public function __construct($producto_id)
    {
        $this->producto_id = $producto_id;
    }

    public function model(array $row)
    {
        return new Especificacion([
            'campo' => $row[0], // Primera columna del Excel
            'descripcion' => $row[1], // Segunda columna del Excel
            'producto_id' => $this->producto_id,
        ]);
    }
}