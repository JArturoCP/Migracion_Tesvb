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
        Schema::create('pres_partida_pres', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_partida_pres', true);
            $table->integer('id_capitulo');
            $table->text('nombre_partida');
            $table->integer('clave_presupuestal');
            $table->text('fecha_registro');
            $table->text('fecha_modificacion');

            $table->primary(['id_partida_pres']);
        });

        Schema::table('pres_partida_pres', function (Blueprint $table) {
            $table->foreign(['id_capitulo'], 'fk_pres_partida_pres_id_capitulo')->references(['id_capitulo'])->on('pres_capitulos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_partida_pres');
    }
};
