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
        Schema::create('ar_corte_alumnos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_ar_corte_alumno', true, true);
            $table->bigInteger('id_ar_corte', false, true);
            $table->integer('id_periodo');
            $table->integer('id_carrera');
            $table->integer('id_materia');
            $table->integer('id_grupo');
            $table->integer('id_unidad')->default(0);
            $table->integer('id_alumno');
            $table->integer('id_carga_academica');
            $table->integer('calificacion')->nullable();
            $table->boolean('reprobado')->default(0);
            $table->integer('materias_reprobadas_periodo', false, true)->default(0);
            $table->enum('semaforo', ['sin_riesgo', 'verde', 'amarillo', 'rojo'])->default('sin_riesgo');
            $table->text('observaciones')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_corte_alumno']);
            $table->unique(['id_ar_corte', 'id_alumno', 'id_carga_academica', 'id_unidad'], 'uq_ar_corte_alumno');
            $table->index(['id_alumno', 'id_periodo', 'id_carrera'], 'idx_ar_alumno_periodo');
            $table->index(['id_periodo', 'id_carrera', 'semaforo'], 'idx_ar_semforo_periodo');
            $table->index(['id_periodo', 'id_carrera', 'id_materia', 'id_grupo', 'id_unidad'], 'idx_ar_materia_unidad');
        });

        Schema::table('ar_corte_alumnos', function (Blueprint $table) {
            $table->foreign(['id_ar_corte'], 'fk_ar_corte_alumnos_corte')->references(['id_ar_corte'])->on('ar_cortes_reprobacion')->onDelete('cascade');
            $table->foreign(['id_alumno'], 'fk_ar_corte_alumnos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carga_academica'], 'fk_ar_corte_alumnos_id_carga_academica')->references(['id_carga_academica'])->on('eva_carga_academica')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_ar_corte_alumnos_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_grupo'], 'fk_ar_corte_alumnos_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_materia'], 'fk_ar_corte_alumnos_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_ar_corte_alumnos_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_ar_corte_alumnos_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_corte_alumnos');
    }
};
