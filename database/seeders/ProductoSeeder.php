<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Caracteristica;

class ProductoSeeder extends Seeder
{
    public function run()
    {
        $laptop = Producto::create([
            'nombre' => 'Laptop Gamer X',
            'categoria' => 'Laptop',
            'precio' => 1500.00,
            'stock' => 5,
        ]);

        Caracteristica::create(['producto_id' => $laptop->id, 'nombre' => 'Procesador', 'valor' => 'Intel i9']);
        Caracteristica::create(['producto_id' => $laptop->id, 'nombre' => 'RAM', 'valor' => '32GB DDR5']);

        $monitor = Producto::create([
            'nombre' => 'Monitor Ultra HD',
            'categoria' => 'Monitor',
            'precio' => 500.00,
            'stock' => 10,
        ]);

        Caracteristica::create(['producto_id' => $monitor->id, 'nombre' => 'Tamaño de pantalla', 'valor' => '32"']);
        Caracteristica::create(['producto_id' => $monitor->id, 'nombre' => 'Resolución', 'valor' => '4K UHD']);

        $gpu = Producto::create([
            'nombre' => 'RTX 4090',
            'categoria' => 'Tarjeta Gráfica',
            'precio' => 2500.00,
            'stock' => 3,
        ]);

        Caracteristica::create(['producto_id' => $gpu->id, 'nombre' => 'Memoria', 'valor' => '24GB GDDR6X']);
        Caracteristica::create(['producto_id' => $gpu->id, 'nombre' => 'Núcleos CUDA', 'valor' => '16384']);
    }
}
