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
        Schema::create('ar_caso_actividad_entregas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_entrega', true, true);
            $table->bigInteger('id_ar_actividad', false, true);
            $table->integer('id_ar_caso', false, true)->nullable();
            $table->integer('id_ar_caso_canalizacion', false, true)->nullable();
            $table->integer('id_ar_cita', false, true)->nullable();
            $table->dateTime('fecha_entrega');
            $table->text('comentario_estudiante')->nullable();
            $table->string('ruta_archivo', 255)->nullable();
            $table->text('texto_evidencia')->nullable();
            $table->string('nombre_original', 255)->nullable();
            $table->string('extension', 20)->nullable();
            $table->string('mime', 100)->nullable();
            $table->bigInteger('size_bytes')->nullable();
            $table->string('estado', 40)->default('entregada');
            $table->integer('id_alumno_entrega')->nullable();
            $table->integer('id_usuario_entrega')->nullable();
            $table->integer('id_usuario_estudiante')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_entrega']);
            $table->index(['id_ar_actividad'], 'idx_ar_entregas_actividad');
            $table->index(['estado'], 'idx_ar_entregas_estado');
            $table->index(['fecha_entrega'], 'idx_ar_entregas_fecha');
            $table->index(['id_ar_actividad'], 'idx_piase_entregas_actividad');
            $table->index(['id_ar_caso'], 'idx_piase_entregas_caso');
            $table->index(['id_ar_caso_canalizacion'], 'idx_piase_entregas_canalizacion');
            $table->index(['id_ar_cita'], 'idx_piase_entregas_cita');
            $table->index(['id_alumno_entrega'], 'idx_piase_entregas_alumno');
        });

        Schema::table('ar_caso_actividad_entregas', function (Blueprint $table) {
            $table->foreign(['id_alumno_entrega'], 'fk_ar_caso_actividad_entregas_id_alumno_entrega')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_actividad'], 'fk_ar_caso_actividad_entregas_id_ar_actividad')->references(['id_ar_actividad'])->on('ar_caso_actividades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_caso_actividad_entregas');
    }
};
