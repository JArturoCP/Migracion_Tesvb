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
        Schema::create('ar_casos_estudiantes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_caso', true, true);
            $table->integer('id_periodo');
            $table->integer('id_carrera')->nullable();
            $table->integer('id_alumno');
            $table->integer('id_asigna_generacion')->nullable();
            $table->integer('id_asigna_tutor')->nullable();
            $table->integer('id_personal_tutor')->nullable();
            $table->string('origen_caso', 80)->default('reprobacion');
            $table->string('estado', 40)->default('abierto');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre')->nullable();
            $table->text('resultado_cierre')->nullable();
            $table->integer('id_usuario_registro')->nullable();
            $table->integer('id_personal_registro')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_caso']);
            $table->unique(['id_periodo', 'id_alumno', 'origen_caso'], 'uq_ar_caso_periodo_alumno_origen');
            $table->index(['id_periodo', 'id_alumno'], 'idx_ar_casos_periodo_alumno');
            $table->index(['id_alumno'], 'idx_ar_casos_alumno');
            $table->index(['id_personal_tutor'], 'idx_ar_casos_tutor');
            $table->index(['estado'], 'idx_ar_casos_estado');
            $table->index(['fecha_apertura'], 'idx_ar_casos_fecha_apertura');
        });

        Schema::table('ar_casos_estudiantes', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ar_casos_estudiantes_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_asigna_generacion'], 'fk_ar_casos_estudiantes_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_asigna_tutor'], 'fk_ar_casos_estudiantes_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_ar_casos_estudiantes_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_ar_casos_estudiantes_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_registro'], 'fk_ar_casos_estudiantes_id_personal_registro')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_tutor'], 'fk_ar_casos_estudiantes_id_personal_tutor')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_casos_estudiantes');
    }
};
