<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    // Método existente para mostrar categorías en la vista 'home'
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Cantidad de elementos por página (por defecto 10)
        $categorias = Categoria::paginate($perPage); // Pagina las categorías
        return view('home', compact('categorias'));
    }

    // Método para mostrar la vista de categorías en el panel de administración
    public function panelIndex(Request $request)
    {
        $perPage = $request->input('perPage', 10); // Cantidad de elementos por página (por defecto 10)
        $categorias = Categoria::paginate($perPage); // Pagina las categorías
        return view('panel.categorias', compact('categorias'));
    }

    // Método para mostrar el formulario de creación de categorías
    public function crear()
    {
        return view('panel.formulario-categoria');
    }

    // Método para guardar una nueva categoría
    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $categoria = new Categoria();
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;

        // Guardar la imagen si se proporciona
    if ($request->hasFile('imagen_url')) {
        $imagen = $request->file('imagen_url');
        $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
        
        // Mover la imagen a la carpeta public/images
        $imagen->move(public_path('images'), $nombreArchivo);
        
        // Guardar solo el nombre del archivo en la base de datos
        $categoria->imagen_url = $nombreArchivo;
    }

    $categoria->save();

        return redirect()->route('panel.categorias')->with('success', 'Categoría creada exitosamente.');
    }

    // Método para mostrar el formulario de edición de categorías
    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('panel.formulario-categoria', compact('categoria'));
    }

    // Método para actualizar una categoría existente
    public function actualizar(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->nombre;
        $categoria->descripcion = $request->descripcion;

        // Si se sube una nueva imagen
    if ($request->hasFile('imagen_url')) {
        // Eliminar la imagen anterior si existe
        if ($categoria->imagen_url && file_exists(public_path('images/' . $categoria->imagen_url))) {
            unlink(public_path('images/' . $categoria->imagen_url));
        }

        // Guardar la nueva imagen
        $imagen = $request->file('imagen_url');
        $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('images'), $nombreArchivo);
        
        // Guardar solo el nombre del archivo en la base de datos
        $categoria->imagen_url = $nombreArchivo;
    }

    $categoria->save();

        return redirect()->route('panel.categorias')->with('success', 'Categoría actualizada exitosamente.');
    }

    // Método para eliminar una categoría
    public function eliminar($id)
    {
        $categoria = Categoria::findOrFail($id);

        // Eliminar la imagen asociada si existe
        if ($categoria->imagen_url && Storage::disk('public')->exists($categoria->imagen_url)) {
            Storage::disk('public')->delete($categoria->imagen_url);
        }

        $categoria->delete();

        return redirect()->route('panel.categorias')->with('success', 'Categoría eliminada exitosamente.');
    }
}