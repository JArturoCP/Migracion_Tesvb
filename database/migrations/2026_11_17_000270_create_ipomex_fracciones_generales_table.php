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
        Schema::create('ipomex_fracciones_generales', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fraccion_general', true);
            $table->integer('id_articulo_general');
            $table->integer('id_articulo_estatal');
            $table->string('fraccion_general', 20);
            $table->integer('tiene_fra_general');
            $table->string('pdf_general', 500);
            $table->text('pdf_general_2');
            $table->string('fraccion_estatal', 20);
            $table->integer('tiene_fra_estatal');
            $table->string('pdf_estatal', 100);
            $table->text('denominacion_fraccion');
            $table->string('periodo_ley_general', 1000);
            $table->text('observacion_inf_general');
            $table->text('periodo_actualizacion_general');
            $table->integer('id_registro_actualizacion');

            $table->primary(['id_fraccion_general']);
        });

        Schema::table('ipomex_fracciones_generales', function (Blueprint $table) {
            $table->foreign(['id_articulo_estatal'], 'fk_ipomex_fracciones_generales_id_articulo_estatal')->references(['id_articulo_estatal'])->on('ipomex_articulos_estatales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_articulo_general'], 'fk_ipomex_fracciones_generales_id_articulo_general')->references(['id_articulo_general'])->on('ipomex_articulos_generales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ipomex_fracciones_generales');
    }
};
