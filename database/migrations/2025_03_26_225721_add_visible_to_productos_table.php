<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->boolean('visible')->default(true)->after('subgrupo_id');
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('visible');
        });
    }
};