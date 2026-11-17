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
        Schema::create('resi_objetivos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_objetivos', true);
            $table->integer('id_anteproyecto');
            $table->text('obj_general');
            $table->text('obj_especifico');
            $table->integer('estado');
            $table->integer('id_periodo_evaluacion_anteproyecto');
            $table->integer('estado_aceptado_objetivos');

            $table->primary(['id_objetivos']);
        });

        Schema::table('resi_objetivos', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_objetivos_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_objetivos');
    }
};
