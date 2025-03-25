<?php
namespace App\Http\Controllers;

use App\Models\ImagenMedio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $config = Configuracion::firstOrCreate([]);
        $precio_dolar = number_format($config->precio_dolar, 2);

        return view('panel.configuracion', compact('precio_dolar'));
    }

    public function actualizarDolar()
    {
        try {
            $response = Http::retry(3, 100)->get('https://api.exchangerate-api.com/v4/latest/USD');

            if ($response->successful()) {
                $data = $response->json();
                $tasa = $data['rates']['PEN'] ?? null;

                if ($tasa) {
                    $config = Configuracion::firstOrCreate([]);
                    $config->precio_dolar = $tasa;
                    $config->save();

                    return response()->json([
                        'success' => true,
                        'precio' => number_format($tasa, 2)
                    ]);
                }
            }

            return response()->json([
                'success' => false,
                'message' => 'No se pudo obtener la tasa de cambio actual'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error en el servidor: ' . $e->getMessage()
            ], 500);
        }
    }

    public function guardarBanner(Request $request)
{
    try {
        $request->validate([
            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'banner_link' => 'nullable|url',
            'banner_alt' => 'nullable|string|max:255'
        ]);

        // Generar token único con extensión
        $extension = $request->file('banner_image')->extension();
        $token = Str::random(40) . '.' . $extension;
        $nombreOriginal = $request->file('banner_image')->getClientOriginalName();
        $mimeType = $request->file('banner_image')->getMimeType();
        $size = $request->file('banner_image')->getSize();

        // Verificar si la carpeta existe
        if (!File::isDirectory(public_path('images'))) {
            File::makeDirectory(public_path('images'), 0755, true);
        }

        // Guardar imagen
        $request->file('banner_image')->move(public_path('images'), $token);

        // Guardar en BD
        $imagen = ImagenMedio::create([
            'token' => $token,
            'nombre_original' => $nombreOriginal,
            'ruta' => 'images/',
            'mime_type' => $mimeType,
            'size' => $size,
            'enlace' => $request->banner_link,
            'texto_alternativo' => $request->banner_alt
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Banner actualizado correctamente',
            'banner_url' => $imagen->url
        ]);

    } catch (\Exception $e) {
        \Log::error('Error al guardar banner: ' . $e->getMessage());
        return response()->json([
            'success' => false,
            'message' => 'Error al guardar el banner: ' . $e->getMessage()
        ], 500);
    }
}
}