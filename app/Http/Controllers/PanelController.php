<?php
// app/Http/Controllers/PanelController.php

namespace App\Http\Controllers;

use App\Models\Scopes\VisibleScope;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Grupo;
use App\Models\Subgrupo;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class PanelController extends Controller
{
    // Método para la página de inicio del panel
    public function index()
    {
        return view('panel.index');
    }

    // Método para la página de productos
    public function productos(Request $request)
    {
        $productos = Producto::withoutGlobalScope(VisibleScope::class)->get();
        $perPage = $request->input('perPage', 10);
        $search = $request->input('search');

        $query = Producto::query();

        if ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('descripcion', 'LIKE', "%{$search}%")
                  ->orWhere('marca', 'LIKE', "%{$search}%")
                  ->orWhere('sku', 'LIKE', "%{$search}%");
        }

        $productos = $query->paginate($perPage);
        $perPageOptions = [10, 20, 50, 100];

        return view('panel.productos', [
            'productos' => $productos,
            'perPage' => $perPage,
            'perPageOptions' => $perPageOptions,
            'search' => $search
        ]);
    }

    public function eliminarProducto($id)
{
    try {
        $producto = Producto::findOrFail($id);

        // Opcional: Eliminar imágenes asociadas si es necesario
        // if($producto->imagen_url && Storage::exists($producto->imagen_url)) {
        //     Storage::delete($producto->imagen_url);
        // }

        $producto->delete();

        return response()->json([
            'success' => true,
            'message' => 'Producto eliminado correctamente'
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al eliminar el producto: ' . $e->getMessage()
        ], 500);
    }
}

    // Método para la página de categorías
    public function categorias()
    {
        return view('panel.categorias');
    }

    // Método para la página de filtros
    public function filtros()
    {
        return view('panel.filtros');
    }

    // Método para la página de banners
    public function banners()
    {
        return view('panel.banners');
    }

    // Método para la página de configuración
    public function configuracion()
    {
        return view('panel.configuracion');
    }

    // Método para mostrar el formulario de creación de productos
    public function mostrarFormularioCrear()
    {
        $categorias = Categoria::all();
        $grupos = Grupo::all();
        $subgrupos = Subgrupo::all();

        return view('panel.formulario-producto', compact('categorias', 'grupos', 'subgrupos'));
    }

    // Método para guardar un nuevo producto con SKU automático
    public function guardarProducto(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:productos',
            'descripcion' => 'nullable|string',
            'caracteristicas' => 'nullable|string',
            'precio_dolares' => 'required|numeric|min:0',
            'precio_soles' => 'required|numeric|min:0',
            'imagen_url' => 'nullable|image|max:4096',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'procesador' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:50',
            'almacenamiento' => 'nullable|string|max:255',
            'pantalla' => 'nullable|string|max:255',
            'graficos' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'descuento' => 'nullable|integer|min:0|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'grupo_id' => 'nullable|exists:grupos,id',
            'subgrupo_id' => 'nullable|exists:subgrupos,id',
        ]);

        // Iniciar transacción para manejar posibles errores
        DB::beginTransaction();

        try {
            // Crear el producto (el SKU se generará automáticamente en el modelo)
            $producto = new Producto($validatedData);

            // Guardar imagen si se sube un archivo
            if ($request->hasFile('imagen_url')) {
                $imagen = $request->file('imagen_url');
                $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
                $rutaImagen = 'images/' . $nombreArchivo;
                $imagen->move(public_path('images'), $nombreArchivo);
                $producto->imagen_url = $nombreArchivo;
            }

            $producto->save();

            DB::commit();

            return redirect()->route('panel.productos')
                   ->with('success', 'Producto creado exitosamente. SKU: ' . $producto->sku);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                   ->with('error', 'Error al crear el producto: ' . $e->getMessage());
        }
    }

    // Método para mostrar el formulario de edición de productos
    public function mostrarFormularioEditar($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $grupos = Grupo::all();
        $subgrupos = Subgrupo::all();

        return view('panel.formulario-producto', compact('producto', 'categorias', 'grupos', 'subgrupos'));
    }

    // Método para actualizar un producto existente
    public function actualizarProducto(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:productos,slug,' . $id,
            'descripcion' => 'nullable|string',
            'caracteristicas' => 'nullable|string',
            'precio_dolares' => 'required|numeric|min:0',
            'precio_soles' => 'required|numeric|min:0',
            'imagen_url' => 'nullable|image|max:4096',
            'marca' => 'nullable|string|max:255',
            'modelo' => 'nullable|string|max:255',
            'procesador' => 'nullable|string|max:255',
            'ram' => 'nullable|string|max:50',
            'almacenamiento' => 'nullable|string|max:255',
            'pantalla' => 'nullable|string|max:255',
            'graficos' => 'nullable|string|max:255',
            'stock' => 'required|integer|min:0',
            'descuento' => 'nullable|integer|min:0|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'grupo_id' => 'nullable|exists:grupos,id',
            'subgrupo_id' => 'nullable|exists:subgrupos,id',
        ]);

        DB::beginTransaction();

        try {
            $producto = Producto::findOrFail($id);
            $producto->fill($validatedData);

            // Si se sube una nueva imagen
            if ($request->hasFile('imagen_url')) {
                // Eliminar la imagen anterior si existe
                if ($producto->imagen_url && File::exists(public_path($producto->imagen_url))) {
                    File::delete(public_path($producto->imagen_url));
                }

                // Guardar nueva imagen
                $imagen = $request->file('imagen_url');
                $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
                $rutaImagen = 'images/' . $nombreArchivo;
                $imagen->move(public_path('images'), $nombreArchivo);
                $producto->imagen_url = $nombreArchivo;
            }

            $producto->save();

            DB::commit();

            return redirect()->route('panel.productos')
                   ->with('success', 'Producto actualizado exitosamente.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                   ->with('error', 'Error al actualizar el producto: ' . $e->getMessage());
        }
    }

    // Método para obtener grupos por categoría
    public function obtenerGruposPorCategoria($categoria_id)
    {
        $grupos = Grupo::where('categoria_id', $categoria_id)->get();
        return response()->json($grupos);
    }

    // Método para obtener subgrupos por grupo
    public function obtenerSubgruposPorGrupo($grupo_id)
    {
        $subgrupos = Subgrupo::where('grupo_id', $grupo_id)->get();
        return response()->json($subgrupos);
    }

    // Método para la página de proveedores
    public function proveedores()
    {
        $proveedores = []; // Reemplaza esto con la lógica para obtener proveedores
        return view('panel.proveedores', compact('proveedores'));
    }

    // Método para cambiar visibilidad del producto
    public function toggleVisibility(Producto $producto, Request $request)
    {
        try {
            $visible = !$producto->visible;
            $producto->update(['visible' => $visible]);

            return response()->json([
                'success' => true,
                'visible' => $visible,
                'message' => 'Visibilidad actualizada'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar'
            ], 500);
        }
    }

    // Método para generar SKU (opcional, si quieres una ruta API)
    public function generarSku()
    {
        return response()->json([
            'sku' => Producto::generateUniqueSku()
        ]);
    }
}
