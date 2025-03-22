<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('especificaciones', function (Blueprint $table) {
            $table->id();
            $table->string('campo'); // Nombre del campo (ejemplo: "Color")
            $table->text('descripcion'); // Descripción del campo (ejemplo: "Rojo")
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade'); // Relación con productos
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('especificaciones');
    }
};