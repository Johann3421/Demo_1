<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('opciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre'); // Nombre de la opción (ej: "HP", "Intel")
            $table->unsignedBigInteger('sub_filtro_id'); // Relación con la tabla sub_filtros
            $table->timestamps();

            // Clave foránea
            $table->foreign('sub_filtro_id')->references('id')->on('sub_filtros')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opciones');
    }
};