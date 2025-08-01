<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    // Mostrar la lista de sliders
    public function index()
    {
        $sliders = Slider::all();
        return view('panel.banners', compact('sliders'));
    }

    // Mostrar el formulario para crear un nuevo slider
    public function crear()
    {
        return view('panel.banners.formulario');
    }

    // Guardar un nuevo slider
    public function guardar(Request $request)
{
    // Validar los datos del formulario
    $request->validate([
        'imagen_url' => 'required|image', // Permitir cualquier tipo de imagen
        'enlace' => 'nullable|url',
    ]);

    // Guardar la imagen en la carpeta public/images/sliders
    $imagen = $request->file('imagen_url');
    $nombreArchivo = Str::slug(pathinfo($imagen->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $imagen->getClientOriginalExtension();
    $rutaImagen = 'images/sliders/' . $nombreArchivo;

    // Mover la imagen a la carpeta public/images/sliders
    if (!file_exists(public_path('images/sliders'))) {
        mkdir(public_path('images/sliders'), 0777, true);
    }
    $imagen->move(public_path('images/sliders'), $nombreArchivo);

    // Crear el nuevo banner en la base de datos
    $slider = Slider::create([
        'imagen_url' => $rutaImagen,
        'enlace' => $request->enlace,
        'status' => 1, // Por defecto, el status será 1 (activo)
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('panel.banners')->with('success', 'Banner creado exitosamente.');
}

    // Mostrar el formulario para editar un slider
    public function editar($id)
    {
        $slider = Slider::findOrFail($id);
        return view('panel.banners.formulario', compact('slider'));
    }

    // Actualizar un slider existente
    public function actualizar(Request $request, $id)
{
    $slider = Slider::findOrFail($id);

    if ($request->hasFile('imagen_url')) {
        // Eliminar imagen anterior si existe
        if ($slider->imagen_url && file_exists(public_path($slider->imagen_url))) {
            unlink(public_path($slider->imagen_url));
        }

        // Preparar nombre único
        $imagen = $request->file('imagen_url');
        $nombreArchivo = 'banner_' . uniqid() . '.' . $imagen->getClientOriginalExtension();
        $rutaPublica = 'images/sliders/' . $nombreArchivo;

        // Asegurar carpeta
        if (!file_exists(public_path('images/sliders'))) {
            mkdir(public_path('images/sliders'), 0777, true);
        }

        // Mover a public/images/sliders
        $imagen->move(public_path('images/sliders'), $nombreArchivo);

        // Guardar ruta relativa
        $slider->imagen_url = $rutaPublica;
    }

    $slider->enlace = $request->enlace;
    $slider->save();

    return redirect()->route('panel.banners')->with('success', 'Banner actualizado correctamente.');
}


    // Eliminar un slider
    public function eliminar($id)
    {
        $slider = Slider::findOrFail($id);

        // Eliminar la imagen asociada si existe
        if (file_exists(public_path($slider->imagen_url))) {
            unlink(public_path($slider->imagen_url));
        }

        $slider->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('panel.banners')->with('success', 'Slider eliminado exitosamente.');
    }
    public function mostrarSlider()
{
    $sliders = Slider::where('status', 1)->get(); // Obtener banners activos
    return view('partials.slider', compact('sliders'));
}
}
