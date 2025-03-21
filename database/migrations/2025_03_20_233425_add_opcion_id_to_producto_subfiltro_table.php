<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('producto_subfiltro', function (Blueprint $table) {
        $table->unsignedBigInteger('opcion_id')->nullable()->after('sub_filtro_id');
        $table->foreign('opcion_id')->references('id')->on('opciones')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('producto_subfiltro', function (Blueprint $table) {
        $table->dropForeign(['opcion_id']);
        $table->dropColumn('opcion_id');
    });
}
};
