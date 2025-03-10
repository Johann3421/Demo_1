<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion');
            $table->text('caracteristicas')->nullable();
            $table->decimal('precio_dolares', 10, 2);
            $table->decimal('precio_soles', 10, 2)->default(0);
            $table->string('imagen_url')->nullable();
            $table->string('marca')->nullable();
            $table->string('modelo')->nullable();
            $table->string('procesador')->nullable();
            $table->string('ram')->nullable();
            $table->string('almacenamiento')->nullable();
            $table->string('pantalla')->nullable();
            $table->string('graficos')->nullable();
            $table->integer('stock')->default(0);
            $table->integer('descuento')->default(0);
            $table->foreignId('categoria_id')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

