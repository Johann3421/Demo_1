<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function getProductosBasicos(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search', '');

        $query = Producto::query()
            ->where('visible', 1)
            ->select([
                'id',
                'nombre',
                'descripcion',
                'precio_soles',
                'imagen_url',
                'categoria_id',
                'slug'
            ]);

        if (!empty($search)) {
            $query->where('nombre', 'like', "%{$search}%");
        }

        $productos = $query->paginate($perPage);

        // Formatear cada producto en la colección
        $productosFormateados = $productos->map(function ($producto) {
            return $this->formatearProducto($producto);
        });

        return response()->json([
            'success' => true,
            'data' => $productosFormateados,
            'pagination' => [
                'total' => $productos->total(),
                'per_page' => $productos->perPage(),
                'current_page' => $productos->currentPage()
            ]
        ], 200, [], JSON_UNESCAPED_SLASHES); // <- Aquí evitamos el escape de barras
    }

    public function getProductoPorId($id)
    {
        $producto = Producto::where('id', $id)
            ->where('visible', 1)
            ->select([
                'id',
                'nombre',
                'descripcion',
                'precio_soles',
                'imagen_url',
                'categoria_id',
                'slug'
            ])
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $this->formatearProducto($producto)
        ], 200, [], JSON_UNESCAPED_SLASHES);
    }

    private function formatearProducto($producto)
    {
        return [
            'id' => $producto->id,
            'nombre' => $producto->nombre,
            'descripcion' => $producto->descripcion,
            'precio_soles' => $producto->precio_soles,
            'imagen_url' => $this->getUrlCompleta($producto->imagen_url),
            'categoria_id' => $producto->categoria_id,
            'slug' => $producto->slug
        ];
    }

    private function getUrlCompleta($ruta)
    {
        if (empty($ruta)) {
            return null;
        }

        if (filter_var($ruta, FILTER_VALIDATE_URL)) {
            return $ruta;
        }

        $ruta = ltrim($ruta, '/');

        // Asumiendo que las imágenes están en /public/images/
        return url("images/{$ruta}");
    }
}
