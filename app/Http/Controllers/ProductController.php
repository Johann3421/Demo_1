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
                'nombre' => 'Tarjeta Grafica Msi Geforce Rtx 4070ti Super 16gb Gddr6x',
                'descripcion' => 'Tarjeta de video de alto rendimiento para gaming y diseño gráfico.',
                'precio' => 299.99,
                'imagen' => 'rtx.webp',
                'marca' => 'MSI',
                'modelo' => 'RTX 4070 Ti Super',
                'procesador' => 'N/A',
                'ram' => '16GB GDDR6X',
                'almacenamiento' => 'N/A',
                'pantalla' => 'N/A',
                'graficos' => 'PCIe 4.0, 3 ventiladores, RGB',
                'stock' => 10,
                'descuento' => 10,
                'slug' => Str::slug('Tarjeta Grafica Msi Geforce Rtx 4070ti Super 16gb Gddr6x')
            ],
            2 => [
                'id' => 2,
                'nombre' => 'Laptop Intel Core I5 16gb 512gb Ssd Ideapad Slim 3i 12° Gen Fhd',
                'descripcion' => 'Laptop potente y ligera para trabajo y entretenimiento.',
                'precio' => 799.99,
                'imagen' => 'laptop.webp',
                'marca' => 'Lenovo',
                'modelo' => 'Ideapad Slim 3i',
                'procesador' => 'Intel Core i5 12° Gen',
                'ram' => '16GB',
                'almacenamiento' => '512GB SSD',
                'pantalla' => '15.6” Full HD',
                'graficos' => 'Intel Iris Xe',
                'stock' => 5,
                'descuento' => 5,
                'slug' => Str::slug('Laptop Intel Core I5 16gb 512gb Ssd Ideapad Slim 3i 12° Gen Fhd')
            ],
            3 => [
                'id' => 3,
                'nombre' => 'Monitor plano 21.5" Teros TE-2127S Panel IPS, FHD (1920 x 1080), 100Hz, 1ms, entradas HDMI/VGA',
                'descripcion' => 'Pantalla Full HD de 24 pulgadas para una experiencia visual increíble.',
                'precio' => 149.99,
                'imagen' => 'monitor.jfif',
                'marca' => 'Teros',
                'modelo' => 'TE-2127S',
                'procesador' => 'N/A',
                'ram' => 'N/A',
                'almacenamiento' => 'N/A',
                'pantalla' => '21.5” IPS Full HD, 100Hz',
                'graficos' => 'HDMI/VGA',
                'stock' => 15,
                'descuento' => 0,
                'slug' => Str::slug('Monitor plano 21.5 Teros TE-2127S Panel IPS FHD 100Hz 1ms HDMI VGA')
            ],
        ];

        // ❌ Verificar si el producto no existe
        if (!isset($productos[$id])) {
            abort(404, 'Producto no encontrado');
        }

        // ✅ Obtener el producto
        $producto = $productos[$id];

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
