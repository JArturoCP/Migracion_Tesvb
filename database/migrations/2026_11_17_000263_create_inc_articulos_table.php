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
        Schema::create('inc_articulos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_articulo', true);
            $table->text('nombre_articulo');
            $table->text('nombre_articulosolo');
            $table->text('descripcion_art');
            $table->integer('id_estado_evid');
            $table->integer('id_dirigido');

            $table->primary(['id_articulo']);
        });

        Schema::table('inc_articulos', function (Blueprint $table) {
            $table->foreign(['id_dirigido'], 'fk_inc_articulos_id_dirigido')->references(['id_dirigido'])->on('inc_dirigido')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_evid'], 'fk_inc_articulos_id_estado_evid')->references(['id_estado_evid'])->on('inc_estado_evidencia')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inc_articulos');
    }
};
