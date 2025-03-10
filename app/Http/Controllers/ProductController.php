<?php
namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // 🛒 Método para mostrar los detalles del producto
    public function show($id)
    {
        // Convertir $id a entero para evitar errores de tipo
        $id = (int) $id;

        // Simulación de datos de productos con clave "id"
        $productos = [
            1 => [
                'id' => 1,
                'nombre' => 'Laptop Lenovo IdeaPad Gaming 3 15IMH05',
                'descripcion' => 'Intel Core i5-10300H, 15.6" FHD, 8GB RAM, 512GB SSD, NVIDIA GeForce GTX 1650 4GB. Ideal para gaming y multitarea.',
                'precio' => 531.23,
                'imagen' => 'lenovo1.png',
                'marca' => 'Lenovo',
                'modelo' => 'IdeaPad Gaming 3 15IMH05',
                'procesador' => 'Intel Core i5-10300H',
                'ram' => '8GB',
                'almacenamiento' => '512GB SSD',
                'pantalla' => '15.6" FHD',
                'graficos' => 'NVIDIA GeForce GTX 1650 4GB',
                'stock' => 10,
                'descuento' => 5,
                'slug' => Str::slug('Laptop Lenovo IdeaPad Gaming 3 15IMH05'),
                'precio_soles' => 0
            ],
            2 => [
                'id' => 2,
                'nombre' => 'Laptop Lenovo IdeaPad Gaming 3 15ARH05',
                'descripcion' => 'AMD Ryzen 7 4800H, 15.6" FHD, 16GB RAM, 1TB HDD + 256GB SSD, NVIDIA GTX 1650 Ti 4GB. Potencia y almacenamiento para gaming.',
                'precio' => 1031.78,
                'imagen' => 'lenovo2.png',
                'marca' => 'Lenovo',
                'modelo' => 'IdeaPad Gaming 3 15ARH05',
                'procesador' => 'AMD Ryzen 7 4800H',
                'ram' => '16GB',
                'almacenamiento' => '1TB HDD + 256GB SSD',
                'pantalla' => '15.6" FHD',
                'graficos' => 'NVIDIA GTX 1650 Ti 4GB',
                'stock' => 8,
                'descuento' => 10,
                'slug' => Str::slug('Laptop Lenovo IdeaPad Gaming 3 15ARH05'),
                'precio_soles' => 0
            ],
            3 => [
                'id' => 3,
                'nombre' => 'Tarjeta de Video Gigabyte GTX 1660 Super',
                'descripcion' => 'NVIDIA GeForce GTX 1660 Super, 6GB GDDR6. Rendimiento excepcional para gaming en 1080p.',
                'precio' => 470.78,
                'imagen' => 'gtx1.png',
                'marca' => 'Gigabyte',
                'modelo' => 'GTX 1660 Super Gaming OC 6G',
                'procesador' => 'N/A',
                'ram' => '6GB GDDR6',
                'almacenamiento' => 'N/A',
                'pantalla' => 'N/A',
                'graficos' => 'NVIDIA GeForce GTX 1660 Super',
                'stock' => 12,
                'descuento' => 0,
                'slug' => Str::slug('Tarjeta de Video Gigabyte GTX 1660 Super'),
                'precio_soles' => 0
            ],
            4 => [
                'id' => 4,
                'nombre' => 'Tarjeta de Video Gigabyte AORUS RTX 3070 Master',
                'descripcion' => 'NVIDIA GeForce RTX 3070, 8GB GDDR6. Tecnología de trazado de rayos en tiempo real para gaming en 4K.',
                'precio' => 1105.00,
                'imagen' => 'gtx2.png',
                'marca' => 'Gigabyte',
                'modelo' => 'AORUS RTX 3070 Master',
                'procesador' => 'N/A',
                'ram' => '8GB GDDR6',
                'almacenamiento' => 'N/A',
                'pantalla' => 'N/A',
                'graficos' => 'NVIDIA GeForce RTX 3070',
                'stock' => 6,
                'descuento' => 15,
                'slug' => Str::slug('Tarjeta de Video Gigabyte AORUS RTX 3070 Master'),
                'precio_soles' => 0
            ],
            5 => [
                'id' => 5,
                'nombre' => 'Monitor AOC 24 G2460PQU',
                'descripcion' => '24" Full HD 1080p, 144Hz, 1ms. Ideal para gaming y diseño con colores precisos y tiempo de respuesta rápido.',
                'precio' => 186.40,
                'imagen' => 'monitor1.png',
                'marca' => 'AOC',
                'modelo' => 'G2460PQU',
                'procesador' => 'N/A',
                'ram' => 'N/A',
                'almacenamiento' => 'N/A',
                'pantalla' => '24" Full HD 1080p, 144Hz',
                'graficos' => 'N/A',
                'stock' => 20,
                'descuento' => 0,
                'slug' => Str::slug('Monitor AOC 24 G2460PQU'),
                'precio_soles' => 0
            ],
            6 => [
                'id' => 6,
                'nombre' => 'Monitor Gigabyte G27FC',
                'descripcion' => '27" Full HD 1080p, 165Hz, 1ms, curvatura 1500R. Experiencia envolvente para gaming y multimedia.',
                'precio' => 226.66,
                'imagen' => 'monitor2.png',
                'marca' => 'Gigabyte',
                'modelo' => 'G27FC',
                'procesador' => 'N/A',
                'ram' => 'N/A',
                'almacenamiento' => 'N/A',
                'pantalla' => '27" Full HD 1080p, 165Hz',
                'graficos' => 'N/A',
                'stock' => 15,
                'descuento' => 5,
                'slug' => Str::slug('Monitor Gigabyte G27FC'),
                'precio_soles' => 0
            ],
        ];

        // ❌ Verificar si el producto no existe
        // 🛠 Corregido: Se debe calcular 'precio_soles' dentro del producto seleccionado
if (!isset($productos[$id])) {
    abort(404, 'Producto no encontrado');
}

$producto = $productos[$id];

// ✅ Asegurar que 'precio' exista antes de la conversión
$producto['precio_soles'] = isset($producto['precio']) ? round($producto['precio'] * 3.8, 2) : 0;

// ✅ Generar URL amigable
$url = route('producto.detalles', ['id' => $producto['id'], 'slug' => $producto['slug']]);

// 🔍 Pasar los datos del producto a la vista
return view('producto.detalles', compact('producto', 'id', 'url'));
    }

    // 🔍 Método de búsqueda optimizado
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Búsqueda avanzada en nombre, descripción y detalles
        $products = Producto::where('nombre', 'like', "%$query%")
            ->orWhere('descripcion', 'like', "%$query%")
            ->orWhere('detalles', 'like', "%$query%")
            ->orderBy('nombre', 'asc')
            ->get();

        return view('search-results', compact('products', 'query'));
    }
    
}