<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Opcion;
use App\Models\SubFiltro;

class OpcionController extends Controller
{
    // Mostrar la lista de opciones
    public function index()
    {
        $opciones = Opcion::with('subFiltro')->get();
        return view('panel.opciones.index', compact('opciones'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
        return view('panel.opciones.formulario', compact('subFiltros'));
    }

    // Guardar una nueva opción
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sub_filtro_id' => 'required|exists:sub_filtros,id',
        ]);

        Opcion::create($request->all());

        return redirect()->route('panel.opciones.index')->with('success', 'Opción creada exitosamente.');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $opcion = Opcion::findOrFail($id);
        $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
        return view('panel.opciones.formulario', compact('opcion', 'subFiltros'));
    }

    // Actualizar una opción existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sub_filtro_id' => 'required|exists:sub_filtros,id',
        ]);

        $opcion = Opcion::findOrFail($id);
        $opcion->update($request->all());

        return redirect()->route('panel.opciones.index')->with('success', 'Opción actualizada exitosamente.');
    }

    // Eliminar una opción
    public function destroy($id)
    {
        $opcion = Opcion::findOrFail($id);
        $opcion->delete();

        return redirect()->route('panel.opciones.index')->with('success', 'Opción eliminada exitosamente.');
    }
}
