<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Método para mostrar todos los productos
    public function index()
{
    // Obtener todos los productos
    $productos = Producto::all();

    // Calcular el precio en soles para cada producto
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Pasar los productos a la vista
    return view('products', compact('productos')); // Asegúrate de que el nombre de la vista sea correcto
}

    // Método para mostrar los detalles del producto desde la base de datos
    public function show($id)
    {
        // Buscar el producto en la base de datos
        $producto = Producto::findOrFail($id);

        // Calcular el precio en soles
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);

        // Generar URL amigable
        $url = route('producto.detalles', ['id' => $producto->id, 'slug' => $producto->slug]);

        // Pasar el producto a la vista
        return view('producto.detalles', compact('producto', 'url'));
    }

    // Método de búsqueda de productos en la base de datos
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Búsqueda en nombre y descripción
        $products = Producto::where('nombre', 'like', "%$query%")
            ->orWhere('descripcion', 'like', "%$query%")
            ->orderBy('nombre', 'asc')
            ->get();

        return view('search-results', compact('products', 'query'));
    }
}