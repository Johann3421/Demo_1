<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProveedorController extends Controller
{
    // Mostrar la lista de proveedores
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('panel.proveedores', compact('proveedores'));
    }

    // Mostrar el formulario de creación
    public function create()
    {
        return view('panel.proveedores.formulario');
    }

    // Guardar un nuevo proveedor
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen_url' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'alt_text' => 'required|string|max:255',
        ]);

        // Guardar la imagen en la carpeta public/images/proveedores
        $imagen = $request->file('imagen_url');
        $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
        $rutaImagen = 'images/proveedores/' . $nombreArchivo;

        // Mover la imagen a la carpeta public/images/proveedores
        if (!file_exists(public_path('images/proveedores'))) {
            mkdir(public_path('images/proveedores'), 0777, true);
        }
        $imagen->move(public_path('images/proveedores'), $nombreArchivo);

        // Crear el nuevo proveedor en la base de datos
        Proveedor::create([
            'nombre' => $request->nombre,
            'imagen_url' => $rutaImagen,
            'url' => $request->url,
            'alt_text' => $request->alt_text,
        ]);

        return redirect()->route('panel.proveedores')->with('success', 'Proveedor creado exitosamente.');
    }

    // Mostrar el formulario de edición
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('panel.proveedores.formulario', compact('proveedor'));
    }

    // Actualizar un proveedor existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'imagen_url' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'nullable|url',
            'alt_text' => 'required|string|max:255',
        ]);

        $proveedor = Proveedor::findOrFail($id);

        // Actualizar la imagen si se proporciona una nueva
        if ($request->hasFile('imagen_url')) {
            // Eliminar la imagen anterior si existe
            if (file_exists(public_path($proveedor->imagen_url))) {
                unlink(public_path($proveedor->imagen_url));
            }

            // Guardar la nueva imagen
            $imagen = $request->file('imagen_url');
            $nombreArchivo = Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $rutaImagen = 'images/proveedores/' . $nombreArchivo;
            $imagen->move(public_path('images/proveedores'), $nombreArchivo);

            $proveedor->imagen_url = $rutaImagen;
        }

        // Actualizar los demás campos
        $proveedor->nombre = $request->nombre;
        $proveedor->url = $request->url;
        $proveedor->alt_text = $request->alt_text;
        $proveedor->save();

        return redirect()->route('panel.proveedores')->with('success', 'Proveedor actualizado exitosamente.');
    }

    // Eliminar un proveedor
    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);

        // Eliminar la imagen asociada si existe
        if (file_exists(public_path($proveedor->imagen_url))) {
            unlink(public_path($proveedor->imagen_url));
        }

        $proveedor->delete();

        return redirect()->route('panel.proveedores')->with('success', 'Proveedor eliminado exitosamente.');
    }
    public function obtenerProveedores()
{
    $proveedores = Proveedor::all()->map(function ($proveedor) {
        return [
            'nombre' => $proveedor->nombre,
            'imagen_url' => asset($proveedor->imagen_url), // 🔹 URL completa de la imagen
            'url' => $proveedor->url,
            'alt_text' => $proveedor->alt_text,
        ];
    });

    return response()->json($proveedores);
}

}