<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especificacion;
use App\Models\Producto;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\EspecificacionesImport;

class EspecificacionController extends Controller
{
    // Mostrar la página principal de especificaciones
    public function index($producto_id)
    {
        $producto = Producto::findOrFail($producto_id);
        $especificaciones = $producto->especificaciones;
        return view('panel.especificaciones.index', compact('producto', 'especificaciones'));
    }
    public function create($producto_id)
{
    $producto = Producto::findOrFail($producto_id);
    return view('panel.especificaciones.create', compact('producto'));
}

    // Mostrar formulario para seleccionar un producto
    public function seleccionarProducto()
    {
        $productos = Producto::all();
        return view('panel.especificaciones.seleccionar_producto', compact('productos'));
    }

    // Guardar una nueva especificación
    public function store(Request $request, $producto_id)
{
    $request->validate([
        'campo' => 'required|string|max:255',
        'descripcion' => 'required|string',
    ]);

    Especificacion::create([
        'campo' => $request->campo,
        'descripcion' => $request->descripcion,
        'producto_id' => $producto_id,
    ]);

    return redirect()->route('panel.especificaciones.index', $producto_id)->with('success', 'Especificación creada exitosamente.');
}

    // Mostrar formulario para editar una especificación
    public function edit($id)
{
    $especificacion = Especificacion::findOrFail($id);
    return view('panel.especificaciones.edit', compact('especificacion'));
}

    // Actualizar una especificación existente
public function update(Request $request, $id)
{
    $request->validate([
        'campo' => 'required|string|max:255',
        'descripcion' => 'required|string',
    ]);

    $especificacion = Especificacion::findOrFail($id);
    $especificacion->update($request->only('campo', 'descripcion'));

    return redirect()->route('panel.especificaciones.index', $especificacion->producto_id)->with('success', 'Especificación actualizada exitosamente.');
}

    // Eliminar una especificación
    public function destroy($id)
{
    $especificacion = Especificacion::findOrFail($id);
    $producto_id = $especificacion->producto_id;
    $especificacion->delete();

    return redirect()->route('panel.especificaciones.index', $producto_id)->with('success', 'Especificación eliminada exitosamente.');
}

    // Importar especificaciones desde Excel
    public function importar(Request $request, $producto_id)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new EspecificacionesImport($producto_id), $request->file('archivo'));

        return redirect()->route('panel.especificaciones.index', $producto_id)->with('success', 'Especificaciones importadas exitosamente.');
    }
}