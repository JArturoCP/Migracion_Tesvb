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
        Schema::create('ar_estrategias_reprobacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_ar_estrategia', true, true);
            $table->integer('id_periodo');
            $table->integer('id_carrera');
            $table->integer('id_alumno');
            $table->integer('total_materias_reprobadas', false, true)->default(0);
            $table->enum('semaforo', ['amarillo', 'rojo']);
            $table->text('estrategia');
            $table->text('seguimiento')->nullable();
            $table->integer('id_personal_responsable')->nullable();
            $table->string('responsable_texto', 255)->nullable();
            $table->date('fecha_compromiso')->nullable();
            $table->date('fecha_seguimiento')->nullable();
            $table->enum('estado', ['pendiente', 'en_seguimiento', 'atendido', 'cerrado'])->default('pendiente');
            $table->integer('id_usuario_registro', false, true)->nullable();
            $table->integer('id_personal_registro')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_estrategia']);
            $table->unique(['id_periodo', 'id_carrera', 'id_alumno'], 'uq_ar_estrategia_alumno_periodo');
            $table->index(['id_periodo', 'id_carrera', 'estado', 'semaforo'], 'idx_ar_estrategia_estado');
            $table->index(['id_alumno', 'id_periodo'], 'idx_ar_estrategia_alumno');
        });

        Schema::table('ar_estrategias_reprobacion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ar_estrategias_reprobacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_ar_estrategias_reprobacion_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_ar_estrategias_reprobacion_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_registro'], 'fk_ar_estrategias_reprobacion_id_personal_registro')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_responsable'], 'fk_ar_estrategias_reprobacion_id_personal_responsable')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_usuario_registro'], 'fk_ar_estrategias_reprobacion_id_usuario_registro')->references(['id'])->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_estrategias_reprobacion');
    }
};
