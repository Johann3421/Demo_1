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
    Schema::table('especificaciones', function (Blueprint $table) {
        $table->unsignedInteger('orden')->default(0)->after('producto_id');
    });
}

public function down()
{
    Schema::table('especificaciones', function (Blueprint $table) {
        $table->dropColumn('orden');
    });
}
};
