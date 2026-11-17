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
        Schema::create('ar_psicologia_diagnosticos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_diagnostico', true, true);
            $table->bigInteger('id_ar_caso', false, true);
            $table->bigInteger('id_ar_caso_canalizacion', false, true)->nullable();
            $table->bigInteger('id_ar_cita', false, true)->nullable();
            $table->integer('id_area_atencion', false, true);
            $table->text('diagnostico_encriptado');
            $table->text('recomendaciones_encriptadas')->nullable();
            $table->dateTime('fecha_diagnostico');
            $table->integer('id_personal_psicologia');
            $table->integer('id_usuario_registro')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_diagnostico']);
            $table->index(['id_ar_caso'], 'idx_ar_psico_caso');
            $table->index(['id_ar_caso_canalizacion'], 'idx_ar_psico_canalizacion');
            $table->index(['id_ar_cita'], 'idx_ar_psico_cita');
            $table->index(['id_area_atencion'], 'idx_ar_psico_area');
            $table->index(['id_personal_psicologia'], 'idx_ar_psico_personal');
            $table->index(['fecha_diagnostico'], 'idx_ar_psico_fecha');
        });

        Schema::table('ar_psicologia_diagnosticos', function (Blueprint $table) {
            $table->foreign(['id_ar_caso'], 'fk_ar_psicologia_diagnosticos_id_ar_caso')->references(['id_ar_caso'])->on('ar_casos_estudiantes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_caso_canalizacion'], 'fk_ar_psicologia_diagnosticos_id_ar_caso_canalizacion')->references(['id_ar_caso_canalizacion'])->on('ar_caso_canalizaciones')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_cita'], 'fk_ar_psicologia_diagnosticos_id_ar_cita')->references(['id_ar_cita'])->on('ar_caso_citas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_atencion'], 'fk_ar_psicologia_diagnosticos_id_area_atencion')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_psicologia'], 'fk_ar_psicologia_diagnosticos_id_personal_psicologia')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_psicologia_diagnosticos');
    }
};
