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
        Schema::create('ar_caso_citas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_cita', true, true);
            $table->bigInteger('id_ar_caso', false, true);
            $table->bigInteger('id_ar_caso_canalizacion', false, true)->nullable();
            $table->integer('id_area_atencion', false, true);
            $table->integer('id_area_responsable_horario', false, true)->nullable();
            $table->integer('numero_sesion')->nullable();
            $table->dateTime('fecha_cita');
            $table->time('hora_inicio_cita')->nullable();
            $table->time('hora_fin_cita')->nullable();
            $table->string('lugar', 150)->nullable();
            $table->string('motivo', 255)->nullable();
            $table->string('estado', 40)->default('programada');
            $table->integer('id_personal_asigna')->nullable();
            $table->integer('id_usuario_asigna')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_cita']);
            $table->index(['id_ar_caso'], 'idx_ar_citas_caso');
            $table->index(['id_ar_caso_canalizacion'], 'idx_ar_citas_canalizacion');
            $table->index(['id_area_atencion'], 'idx_ar_citas_area');
            $table->index(['fecha_cita'], 'idx_ar_citas_fecha');
            $table->index(['estado'], 'idx_ar_citas_estado');
            $table->index(['id_area_responsable_horario'], 'idx_ar_citas_horario');
            $table->index(['id_area_responsable_horario', 'fecha_cita', 'hora_inicio_cita', 'hora_fin_cita'], 'idx_ar_citas_horario_fecha_slot');
        });

        Schema::table('ar_caso_citas', function (Blueprint $table) {
            $table->foreign(['id_ar_caso'], 'fk_ar_caso_citas_id_ar_caso')->references(['id_ar_caso'])->on('ar_casos_estudiantes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_caso_canalizacion'], 'fk_ar_caso_citas_id_ar_caso_canalizacion')->references(['id_ar_caso_canalizacion'])->on('ar_caso_canalizaciones')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_atencion'], 'fk_ar_caso_citas_id_area_atencion')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_responsable_horario'], 'fk_ar_caso_citas_id_area_responsable_horario')->references(['id_area_responsable_horario'])->on('ar_area_responsable_horarios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_asigna'], 'fk_ar_caso_citas_id_personal_asigna')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_caso_citas');
    }
};
