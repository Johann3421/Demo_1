<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Grupo;
use App\Models\Producto;
use App\Models\Subgrupo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // Método para mostrar todos los productos
    public function index(Request $request)
{
    $producto = Producto::find(1);
$sku = $producto->sku; // Acceder al campo SKU

// Buscar producto por SKU
$producto = Producto::where('sku', 'SKU-123456')->first();
    // Obtener todas las categorías
    $categorias = Categoria::all();

    // Construir la consulta base
    $query = Producto::query();

    // Filtro por categoría
    if ($request->filled('categoria_id')) {
        $query->where('categoria_id', $request->categoria_id);
    }

    // Filtro por subfiltros y opciones seleccionadas
    if ($request->has('filtros')) {
        foreach ($request->filtros as $subFiltroNombre => $opcionesSeleccionadas) {
            $query->whereHas('opciones', function ($q) use ($opcionesSeleccionadas) {
                $q->whereIn('nombre', $opcionesSeleccionadas);
            });
        }
    }

    // Filtro por precio máximo en dólares
    if ($request->filled('max_price') && is_numeric($request->max_price)) {
        $precioEnDolares = $request->max_price / 3.8; // Convertir soles a dólares
        $query->where('precio_dolares', '<=', $precioEnDolares);
    }

    // Filtro por stock y ofertas
    if ($request->has('stock')) {
        if (in_array('on-sale', $request->stock)) {
            $query->where('en_oferta', true);
        }
        if (in_array('in-stock', $request->stock)) {
            $query->where('stock', '>', 0);
        }
    }

    // Paginación
    $perPage = $request->get('per_page', 6);
    $productos = $query->paginate($perPage);

    // Calcular el precio en soles para cada producto
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Obtener 3 productos aleatorios para "Top de Ventas"
    $topVentas = Producto::inRandomOrder()->limit(3)->get();

    // Pasar datos a la vista
    return view('products', compact('productos', 'topVentas', 'categorias'));
}


    // Método para mostrar los detalles del producto desde la base de datos
    public function show($id)
    {
        $producto = Producto::with('especificaciones')->findOrFail($id);
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

    // Método para filtrar productos
    public function filter(Request $request)
{
    // Validar los parámetros de la solicitud
    $request->validate([
        'max_price' => 'nullable|numeric|min:0',
        'stock' => 'nullable|array',
        'stock.*' => 'in:on-sale,in-stock',
        'categoria_id' => 'nullable|exists:categorias,id',
        'per_page' => 'nullable|integer|min:1',
    ]);

    // Construir la consulta
    $query = Producto::query();

    // Filtro por precio máximo
    if ($request->has('max_price') && $request->max_price != '') {
        $query->where('precio_soles', '<=', $request->max_price);
    }

    // Filtro por stock
    if ($request->has('stock')) {
        if (in_array('on-sale', $request->stock)) {
            $query->where('en_oferta', true);
        }
        if (in_array('in-stock', $request->stock)) {
            $query->where('stock', '>', 0);
        }
    }

    // Filtro por categoría
    if ($request->has('categoria_id') && $request->categoria_id != '') {
        $query->where('categoria_id', $request->categoria_id);
    }

    // Paginación
    $perPage = $request->get('per_page', 6); // Cantidad de productos por página (por defecto 6)
    $productos = $query->paginate($perPage);

    // Calcular el precio en soles para cada producto
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Devolver una respuesta JSON con los productos y la paginación
    return response()->json([
        'productos' => $productos->items(), // Lista de productos
        'pagination' => $productos->links('pagination::bootstrap-4')->toHtml(), // HTML de la paginación
    ]);
}
public function getLatestProducts()
{
    $productos = Producto::inRandomOrder()->take(12)->get();
    return view('partials.product-slider', compact('productos'));
}
// app/Http/Controllers/ProductoController.php
public function filtrarPorCategoria($categoria)
{
    // Obtener la categoría por su nombre
    $categoria = Categoria::where('nombre', $categoria)->firstOrFail();

    // Filtrar productos por categoría
    $productos = Producto::where('categoria_id', $categoria->id)->paginate(6);

    // Calcular el precio en soles
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Obtener todas las categorías para el menú
    $categorias = Categoria::all();

    // Obtener 3 productos aleatorios para "Top de Ventas"
    $topVentas = Producto::inRandomOrder()->limit(3)->get();

    // Pasar datos a la vista
    return view('products', compact('productos', 'topVentas', 'categorias'));
}

public function filtrarPorGrupo($grupo)
{
    // Obtener el grupo por su nombre
    $grupo = Grupo::where('nombre', $grupo)->firstOrFail();

    // Filtrar productos por grupo
    $productos = Producto::where('grupo_id', $grupo->id)->paginate(6);

    // Calcular el precio en soles
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Obtener todas las categorías para el menú
    $categorias = Categoria::all();

    // Obtener 3 productos aleatorios para "Top de Ventas"
    $topVentas = Producto::inRandomOrder()->limit(3)->get();

    // Pasar datos a la vista
    return view('products', compact('productos', 'topVentas', 'categorias'));
}

public function filtrarPorSubgrupo($subgrupo)
{
    // Obtener el subgrupo por su nombre
    $subgrupo = Subgrupo::where('nombre', $subgrupo)->firstOrFail();

    // Filtrar productos por subgrupo
    $productos = Producto::where('subgrupo_id', $subgrupo->id)->paginate(6);

    // Calcular el precio en soles
    foreach ($productos as $producto) {
        $producto->precio_soles = round($producto->precio_dolares * 3.8, 2);
    }

    // Obtener todas las categorías para el menú
    $categorias = Categoria::all();

    // Obtener 3 productos aleatorios para "Top de Ventas"
    $topVentas = Producto::inRandomOrder()->limit(3)->get();

    // Pasar datos a la vista
    return view('products', compact('productos', 'topVentas', 'categorias'));
}
public function buscar(Request $request)
{
    $query = $request->input('query');

    $productos = Producto::where('nombre', 'LIKE', "%{$query}%")
        ->orWhere('descripcion', 'LIKE', "%{$query}%")
        ->limit(6)
        ->get();

    return response()->json($productos);
}


}
