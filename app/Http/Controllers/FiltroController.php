<?php
namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Subgrupo;
use App\Models\Categoria;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class FiltroController extends Controller
{
    // Mostrar la vista de filtros
    public function index(Request $request)
{
    // Obtener todas las categorías (sin paginación)
    $categorias = Categoria::with(['grupos.subgrupos'])->get();

    // Obtener grupos y subgrupos con paginación
    $perPage = $request->input('perPage', 10); // Cantidad de elementos por página (por defecto 10)
    $grupos = Grupo::with('categoria')->paginate($perPage); // Pagina los grupos
    $subgrupos = Subgrupo::with('grupo')->paginate($perPage); // Pagina los subgrupos

    // Compartir las variables con todas las vistas
    View::share('categorias', $categorias);
    View::share('grupos', $grupos);
    View::share('subgrupos', $subgrupos);

    return view('panel.filtros', compact('categorias', 'grupos', 'subgrupos'));
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
        $subgrupo = Subgrupo::findOrFail($id);
        $subgrupo->delete();

        return redirect()->route('panel.filtros')->with('success', 'Subgrupo eliminado exitosamente.');
    }
}
