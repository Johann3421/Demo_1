<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Método para mostrar los detalles del producto
    public function show($id)
{
    // Simulación de datos de productos
    $productos = [
        1 => [
            'nombre' => 'Tarjeta Grafica Msi Geforce Rtx 4070ti Super 16gb Gddr6x',
            'descripcion' => 'Tarjeta de video de alto rendimiento para gaming y diseño gráfico.',
            'precio' => '$299.99',
            'imagen' => 'rtx.webp',
            'detalles' => 'Detalles técnicos: 16GB GDDR6X, 256-bit, PCIe 4.0, 3 ventiladores, RGB personalizable.'
        ],
        2 => [
            'nombre' => 'Laptop Intel Core I5 16gb 512gb Ssd Ideapad Slim 3i 12° Gen Fhd',
            'descripcion' => 'Laptop potente y ligera para trabajo y entretenimiento.',
            'precio' => '$799.99',
            'imagen' => 'laptop.webp',
            'detalles' => 'Detalles técnicos: Intel Core i5, 16GB RAM, 512GB SSD, pantalla Full HD, Windows 11.'
        ],
        3 => [
            'nombre' => 'Monitor plano 21.5" Teros TE-2127S Panel IPS, FHD (1920 x 1080), 100Hz, 1ms, entradas HDMI/VGA',
            'descripcion' => 'Pantalla Full HD de 24 pulgadas para una experiencia visual increíble.',
            'precio' => '$149.99',
            'imagen' => 'monitor.jfif',
            'detalles' => 'Detalles técnicos: Panel IPS, 100Hz, 1ms de tiempo de respuesta, HDMI/VGA.'
        ],
    ];

    // Verificar si el producto existe
    if (!array_key_exists($id, $productos)) {
        abort(404, 'Producto no encontrado');
    }

    // Pasar los datos del producto y el ID a la vista
    return view('producto.detalles', [
        'producto' => $productos[$id],
        'id' => $id // Pasamos el ID del producto
    ]);
}
}