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
        Schema::create('in_carga_academica_ingles', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_carga_ingles', true);
            $table->integer('id_alumno');
            $table->integer('id_nivel');
            $table->integer('id_grupo');
            $table->integer('id_periodo_ingles');
            $table->integer('estado_nivel');

            $table->primary(['id_carga_ingles']);
            $table->index(['id_alumno', 'id_periodo_ingles'], 'idx_carga_alumno_periodo');
            $table->index(['id_periodo_ingles', 'id_nivel', 'id_grupo'], 'idx_carga_periodo_nivel_grupo');
        });

        Schema::table('in_carga_academica_ingles', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_in_carga_academica_ingles_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_grupo'], 'fk_in_carga_academica_ingles_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_ingles'], 'fk_in_carga_academica_ingles_id_periodo_ingles')->references(['id_periodo_ingles'])->on('in_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_carga_academica_ingles');
    }
};
