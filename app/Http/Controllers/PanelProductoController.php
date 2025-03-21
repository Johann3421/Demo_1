<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\SubFiltro;
use App\Models\Opcion;

class PanelProductoController extends Controller
{
    public function asignarOpciones()
    {
        $productos = Producto::all();
        $subFiltros = SubFiltro::all();
        return view('panel.asignar_opciones', compact('productos', 'subFiltros'));
    }

    public function guardarOpciones(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'subfiltro_id' => 'required|exists:sub_filtros,id',
            'opciones' => 'required|array'
        ]);

        $producto = Producto::findOrFail($request->producto_id);
        $producto->opciones()->sync($request->opciones);

        return redirect()->back()->with('success', 'Opciones asignadas correctamente.');
    }
}
