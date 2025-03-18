<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubFiltro;
use App\Models\Opcion;

class SubFiltroController extends Controller
{
    // Mostrar la lista de sub-filtros y opciones
    public function index()
    {
        $subFiltros = SubFiltro::with('opciones')->get();
        return view('panel.subfiltro', compact('subFiltros'));
    }

    // Mostrar el formulario para crear o editar un sub-filtro
    public function mostrarFormularioSubFiltro($id = null)
{
    $subFiltro = $id ? SubFiltro::findOrFail($id) : null;
    $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
    return view('panel.subfiltro.formulario', compact('subFiltro', 'subFiltros'));
}

    // Guardar o actualizar un sub-filtro
    public function guardarSubFiltro(Request $request, $id = null)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        if ($id) {
            // Actualizar sub-filtro existente
            $subFiltro = SubFiltro::findOrFail($id);
            $subFiltro->update($request->all());
            $mensaje = 'Sub-Filtro actualizado exitosamente.';
        } else {
            // Crear nuevo sub-filtro
            SubFiltro::create($request->all());
            $mensaje = 'Sub-Filtro creado exitosamente.';
        }

        return redirect()->route('panel.subfiltro')->with('success', $mensaje);
    }

    // Mostrar el formulario para crear o editar una opción
    public function mostrarFormularioOpcion($id = null)
{
    $opcion = $id ? Opcion::findOrFail($id) : null;
    $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
    return view('panel.subfiltro.formulario', compact('opcion', 'subFiltros'));
}

    // Guardar o actualizar una opción
    public function guardarOpcion(Request $request, $id = null)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'sub_filtro_id' => 'required|exists:sub_filtros,id',
        ]);

        if ($id) {
            // Actualizar opción existente
            $opcion = Opcion::findOrFail($id);
            $opcion->update($request->all());
            $mensaje = 'Opción actualizada exitosamente.';
        } else {
            // Crear nueva opción
            Opcion::create($request->all());
            $mensaje = 'Opción creada exitosamente.';
        }

        return redirect()->route('panel.subfiltro')->with('success', $mensaje);
    }

    // Eliminar un sub-filtro
    public function eliminarSubFiltro($id)
    {
        $subFiltro = SubFiltro::findOrFail($id);
        $subFiltro->delete();

        return redirect()->route('panel.subfiltro')->with('success', 'Sub-Filtro eliminado exitosamente.');
    }

    // Eliminar una opción
    public function eliminarOpcion($id)
    {
        $opcion = Opcion::findOrFail($id);
        $opcion->delete();

        return redirect()->route('panel.subfiltro')->with('success', 'Opción eliminada exitosamente.');
    }
    public function buscarSubFiltros(Request $request)
{
    $query = $request->input('q');

    // Buscar opciones de sub-filtros que coincidan con la consulta
    $opciones = Opcion::where('nombre', 'like', "%$query%")
        ->with('subFiltro') // Cargar la relación con el sub-filtro
        ->get();

    // Formatear los resultados para la respuesta JSON
    $resultados = $opciones->map(function ($opcion) {
        return [
            'id' => $opcion->id,
            'nombre' => $opcion->nombre,
            'sub_filtro' => $opcion->subFiltro->nombre, // Nombre del sub-filtro relacionado
        ];
    });

    return response()->json($resultados);
}
}