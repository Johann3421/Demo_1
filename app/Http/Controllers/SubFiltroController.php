<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\SubFiltro;
use App\Models\Opcion;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

class SubFiltroController extends Controller
{
    // Mostrar la lista de sub-filtros y opciones con paginación y cantidad de items
    public function index(Request $request)
    {
        // Guardar la pestaña activa en la sesión si se envía en la solicitud
    if ($request->has('tab')) {
        Session::put('active_tab', $request->input('tab'));
    }

    // Recuperar la pestaña activa de la sesión
    $activeTab = Session::get('active_tab', 'subfiltros'); // Por defecto, 'subfiltros'
        
        $perPage = $request->input('per_page', 10); // Valor por defecto 10
        $subFiltros = SubFiltro::with('opciones')->paginate($perPage);
        return view('panel.subfiltro', compact('subFiltros', 'perPage','activeTab'));
    }

    // Mostrar el formulario para crear o editar un sub-filtro
    public function mostrarFormularioSubFiltro($id = null)
    {
        $categorias = Categoria::all();
        $subFiltro = $id ? SubFiltro::findOrFail($id) : null;
        $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
        return view('panel.subfiltro.formulario', compact('subFiltro', 'subFiltros','categorias'));
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
        $categorias = Categoria::all();
        $opcion = $id ? Opcion::findOrFail($id) : null;
        $subFiltros = SubFiltro::all(); // Obtener todos los sub-filtros para el select
        return view('panel.subfiltro.formulario', compact('opcion', 'subFiltros','categorias'));
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
    
    // Buscar sub-filtros
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
    public function getSubFiltrosPorCategoria($categoria_id)
    {
        $subFiltros = SubFiltro::where('categoria_id', $categoria_id)
            ->with('opciones') // Cargar opciones relacionadas
            ->get();

        return response()->json($subFiltros);
    }
}
