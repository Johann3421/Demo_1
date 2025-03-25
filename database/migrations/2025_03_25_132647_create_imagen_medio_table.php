<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_imagen_medio_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('imagen_medio', function (Blueprint $table) {
            $table->id();
            $table->string('token')->unique();
            $table->string('nombre_original');
            $table->string('ruta')->default('images/');
            $table->string('mime_type');
            $table->integer('size');
            $table->string('enlace')->nullable();
            $table->string('texto_alternativo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('imagen_medio');
    }
};