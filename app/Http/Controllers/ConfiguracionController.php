<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Configuracion;

class ConfiguracionController extends Controller
{

    public function index()
    {
        $config = Configuracion::first();
        $precio_dolar = $config ? number_format($config->precio_dolar, 2) : '0.00';

        return view('panel.configuracion', compact('precio_dolar'));
    }
    public function actualizarDolar()
    {
        $response = Http::get('https://api.exchangerate-api.com/v4/latest/USD');

        if ($response->successful()) {
            $data = $response->json();
            $tasa = $data['rates']['PEN'] ?? null; // Cambio de USD a Soles

            if ($tasa) {
                // Guardar en la base de datos
                $config = Configuracion::first();
                if (!$config) {
                    $config = new Configuracion();
                }
                $config->precio_dolar = $tasa;
                $config->save();

                return response()->json(['success' => true, 'precio' => number_format($tasa, 2)]);
            }
        }

        return response()->json(['success' => false, 'message' => 'No se pudo obtener la tasa de cambio']);
    }
}
