<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('caracteristicas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->string('nombre'); // Ej: Procesador, RAM, Tamaño de pantalla
            $table->string('valor'); // Ej: Intel i7, 16GB DDR4, 27"
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('caracteristicas');
    }
};
