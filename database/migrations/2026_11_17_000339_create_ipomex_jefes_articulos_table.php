<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ipomex_jefes_articulos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_jefes_articulos', true);
            $table->integer('id_unidad_admin');
            $table->integer('id_fraccion_general');

            $table->primary(['id_jefes_articulos']);
        });

        Schema::table('ipomex_jefes_articulos', function (Blueprint $table) {
            $table->foreign(['id_fraccion_general'], 'fk_ipomex_jefes_articulos_id_fraccion_general')->references(['id_fraccion_general'])->on('ipomex_fracciones_generales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipomex_jefes_articulos');
    }
};
