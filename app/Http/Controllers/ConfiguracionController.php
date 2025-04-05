<?php
namespace App\Http\Controllers;

use App\Models\ImagenMedio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Configuracion;
use Illuminate\Support\Facades\Storage;
use DOMDocument;
use DOMXPath;

class ConfiguracionController extends Controller
{
    public function index()
    {
        $config = Configuracion::firstOrCreate([]);
        $precio_dolar = number_format($config->precio_dolar, 2);

        return view('panel.configuracion', compact('precio_dolar'));
    }

    public function actualizarDolarDeltron()
{
    try {
        $response = Http::retry(2, 100)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ])
            ->get('https://www.deltron.com.pe/index_2.php');

        if ($response->successful()) {
            $html = $response->body();
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            $elementos = $xpath->query("//li[contains(@class, 'address') and contains(., 'Tipo de cambio')]");

            if ($elementos->length > 0) {
                $texto = trim($elementos->item(0)->nodeValue);
                if (preg_match('/\d+\.\d+/', $texto, $matches)) {
                    return $this->guardarTipoCambio($matches[0], 'Deltron');
                }
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'No se encontró el tipo de cambio en Deltron'
        ], 400);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener de Deltron: ' . $e->getMessage()
        ], 500);
    }
}

public function actualizarDolarGoogle()
{
    try {
        $response = Http::retry(3, 100)
            ->withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ])
            ->get('https://www.google.com/finance/quote/USD-PEN');

        if ($response->successful()) {
            $html = $response->body();
            if (preg_match('/data-last-price="([\d.]+)"/', $html, $matches)) {
                return $this->guardarTipoCambio($matches[1], 'Google Finance');
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'No se pudo obtener la tasa de Google'
        ], 400);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al obtener de Google: ' . $e->getMessage()
        ], 500);
    }
}

    private function guardarTipoCambio($tasa, $fuente)
    {
        $config = Configuracion::firstOrCreate([]);
        $config->precio_dolar = $tasa;
        $config->save();

        return response()->json([
            'success' => true,
            'precio' => number_format($tasa, 2),
            'fuente' => $fuente
        ]);
    }

    public function actualizarManual(Request $request)
    {
        $request->validate([
            'nuevo_precio' => 'required|numeric|min:0.01'
        ]);

        try {
            $config = Configuracion::firstOrCreate([]);
            $config->precio_dolar = $request->nuevo_precio;
            $config->save();

            return response()->json([
                'success' => true,
                'precio' => number_format($request->nuevo_precio, 2)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar: ' . $e->getMessage()
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
