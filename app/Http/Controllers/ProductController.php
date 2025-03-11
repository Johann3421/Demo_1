<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Método para mostrar todos los productos
    public function index(Request $request)
{
    // Obtener la categoría desde la URL (si no hay, usa "Productos")
    $categoriaActual = $request->query('categoria', 'Productos');

    // Filtrar productos por categoría si se especifica
    $productos = Producto::when($categoriaActual !== 'Productos', function ($query) use ($categoriaActual) {
        return $query->whereHas('categoria', function ($q) use ($categoriaActual) {
            $q->where('nombre', $categoriaActual);
        });
    })->get();

    // Calcular el precio en soles
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Obtener 3 productos aleatorios para "Top de Ventas"
    $topVentas = Producto::inRandomOrder()->limit(3)->get();

    // Pasar datos a la vista
    return view('products', compact('productos', 'topVentas', 'categoriaActual'));
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
    public function filter(Request $request)
{
    $query = Producto::query();

    // Filtrar por precio
    if ($request->filled('min_price') && $request->filled('max_price')) {
        $query->whereBetween('precio_dolares', [$request->min_price, $request->max_price]);
    }

    // Filtrar por stock
    if ($request->filled('stock')) {
        if ($request->stock == 'in-stock') {
            $query->where('stock', '>', 0);
        } elseif ($request->stock == 'on-sale') {
            $query->where('descuento', '>', 0);
        }
    }

    // Filtrar por categoría
    if ($request->filled('categoria_id')) {
        $query->where('categoria_id', $request->categoria_id);
    }

    // Obtener los productos filtrados
    $productos = $query->get();

    // Calcular el precio en soles
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Retornar la vista parcial con los productos filtrados
    return view('components.product-list', compact('productos'));
}


}