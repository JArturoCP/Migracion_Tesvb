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
        Schema::create('resi_justificacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_justificacion', true);
            $table->integer('id_anteproyecto');
            $table->text('justificacion');
            $table->integer('estado');
            $table->integer('id_periodo_evaluacion_anteproyecto');
            $table->integer('estado_aceptado_justificacion');

            $table->primary(['id_justificacion']);
        });

        Schema::table('resi_justificacion', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_justificacion_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_justificacion');
    }
};
