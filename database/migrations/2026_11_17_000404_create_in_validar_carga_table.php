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
        Schema::create('in_validar_carga', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_validar_carga', true);
            $table->integer('id_alumno');
            $table->integer('id_periodo');
            $table->integer('id_estado');
            $table->text('comentario');

            $table->primary(['id_validar_carga']);
            $table->index(['id_alumno', 'id_periodo', 'id_estado'], 'idx_validar_alumno_periodo_estado');
        });

        Schema::table('in_validar_carga', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_in_validar_carga_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_in_validar_carga_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_validar_carga');
    }
};
