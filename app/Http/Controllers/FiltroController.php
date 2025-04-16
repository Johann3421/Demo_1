<?php
namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiltroController extends Controller
{
    // Mostrar la vista de filtros
    public function index(Request $request)
{
    // Obtener todas las categorías (sin paginación)
    $categorias = Categoria::with(['grupos.subgrupos'])->get();

    // Obtener parámetros
    $perPage = $request->input('perPage', 10);
    $activeTab = $request->input('activeTab', 'grupos');
    $search = $request->input('search');

    // Paginación de grupos
    $grupos = Grupo::with('categoria')
        ->when($activeTab == 'grupos' && $search, function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhereHas('categoria', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
        })
        ->orderBy('nombre')
        ->paginate($perPage, ['*'], 'grupos_page')
        ->appends([
            'perPage' => $perPage,
            'activeTab' => $activeTab,
            'search' => $search
        ]);

    // Paginación de subgrupos
    $subgrupos = Subgrupo::with('grupo')
        ->when($activeTab == 'subgrupos' && $search, function($query) use ($search) {
            $query->where('nombre', 'like', "%{$search}%")
                  ->orWhereHas('grupo', function($q) use ($search) {
                      $q->where('nombre', 'like', "%{$search}%");
                  });
        })
        ->orderBy('nombre')
        ->paginate($perPage, ['*'], 'subgrupos_page')
        ->appends([
            'perPage' => $perPage,
            'activeTab' => $activeTab,
            'search' => $search
        ]);

    return view('panel.filtros', compact('categorias', 'grupos', 'subgrupos', 'perPage', 'activeTab', 'search'));
}

    // Métodos para Grupos
    public function crearGrupo()
    {
        $categorias = Categoria::all();
        return view('panel.filtros.formulario-grupo', compact('categorias'));
    }

    public function guardarGrupo(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    Grupo::create([
        'nombre' => $request->nombre,
        'categoria_id' => $request->categoria_id
    ]);

    return redirect()->route('panel.filtros')->with('success', 'Grupo creado exitosamente.');
}

    public function editarGrupo($id)
    {
        $grupo = Grupo::findOrFail($id);
        $categorias = Categoria::all();
        return view('panel.filtros.formulario-grupo', compact('grupo', 'categorias'));
    }

    public function actualizarGrupo(Request $request, $id)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'categoria_id' => 'required|exists:categorias,id',
    ]);

    $grupo = Grupo::findOrFail($id);
    $grupo->update([
        'nombre' => $request->nombre,
        'categoria_id' => $request->categoria_id
    ]);

    return redirect()->route('panel.filtros')->with('success', 'Grupo actualizado exitosamente.');
}

    public function eliminarGrupo($id)
    {
        $grupo = Grupo::findOrFail($id);
        $grupo->delete();

        return redirect()->route('panel.filtros')->with('success', 'Grupo eliminado exitosamente.');
    }

    // Métodos para Subgrupos
    public function crearSubgrupo()
    {
        $grupos = Grupo::all();
        return view('panel.filtros.formulario-subgrupo', compact('grupos'));
    }

    public function guardarSubgrupo(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'grupo_id' => 'required|exists:grupos,id',
    ]);

    Subgrupo::create([
        'nombre' => $request->nombre,
        'grupo_id' => $request->grupo_id
    ]);

    return redirect()->route('panel.filtros')->with('success', 'Subgrupo creado exitosamente.');
}

    public function editarSubgrupo($id)
    {
        $subgrupo = Subgrupo::findOrFail($id);
        $grupos = Grupo::all();
        return view('panel.filtros.formulario-subgrupo', compact('subgrupo', 'grupos'));
    }

    public function actualizarSubgrupo(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $subgrupo = Subgrupo::findOrFail($id);
        $subgrupo->update($request->all());

        return redirect()->route('panel.filtros')->with('success', 'Subgrupo actualizado exitosamente.');
    }

    public function eliminarSubgrupo($id)
{
    DB::transaction(function () use ($id) {
        $subgrupo = Subgrupo::findOrFail($id);

        // Opción 2.1: Reasignar productos a otro subgrupo
        // Producto::where('subgrupo_id', $id)->update(['subgrupo_id' => null]);

        // Opción 2.2: Eliminar productos relacionados primero
        $subgrupo->productos()->delete();

        $subgrupo->delete();
    });

    return redirect()->route('panel.filtros')
           ->with('success', 'Subgrupo eliminado exitosamente.');
}
}
