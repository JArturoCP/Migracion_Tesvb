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
        Schema::create('exp_area_psicopedagogica', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_area_psicopedagogica', true);
            $table->integer('rendimiento_escolar')->nullable();
            $table->integer('dominio_idioma')->nullable();
            $table->integer('otro_idioma')->nullable();
            $table->integer('conocimiento_compu')->nullable();
            $table->integer('aptitud_especial')->nullable();
            $table->integer('comprension')->nullable();
            $table->integer('preparacion')->nullable();
            $table->integer('estrategias_aprendizaje')->nullable();
            $table->integer('organizacion_actividades')->nullable();
            $table->integer('concentracion')->nullable();
            $table->integer('solucion_problemas')->nullable();
            $table->integer('condiciones_ambientales')->nullable();
            $table->integer('busqueda_bibliografica')->nullable();
            $table->integer('trabajo_equipo')->nullable();
            $table->integer('id_alumno');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_area_psicopedagogica']);
        });

        Schema::table('exp_area_psicopedagogica', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_area_psicopedagogica_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_area_psicopedagogica');
    }
};
