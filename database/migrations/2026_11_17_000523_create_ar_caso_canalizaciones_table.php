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
        Schema::create('ar_caso_canalizaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_caso_canalizacion', true, true);
            $table->bigInteger('id_ar_caso', false, true);
            $table->integer('id_area_origen', false, true)->nullable();
            $table->integer('id_area_destino', false, true);
            $table->integer('id_causa_reprobacion', false, true)->nullable();
            $table->integer('id_personal_canaliza')->nullable();
            $table->integer('id_usuario_canaliza')->nullable();
            $table->integer('id_area_responsable_periodo_destino', false, true)->nullable();
            $table->integer('id_personal_responsable_destino')->nullable();
            $table->integer('id_area_responsable_horario_destino', false, true)->nullable();
            $table->dateTime('fecha_canalizacion');
            $table->string('estado', 40)->default('canalizado');
            $table->string('observaciones', 500)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_caso_canalizacion']);
            $table->index(['id_ar_caso'], 'idx_ar_canalizaciones_caso');
            $table->index(['id_area_destino'], 'idx_ar_canalizaciones_destino');
            $table->index(['id_area_origen'], 'idx_ar_canalizaciones_origen');
            $table->index(['id_causa_reprobacion'], 'idx_ar_canalizaciones_causa');
            $table->index(['fecha_canalizacion'], 'idx_ar_canalizaciones_fecha');
            $table->index(['id_personal_canaliza'], 'idx_ar_canalizaciones_personal');
            $table->index(['estado'], 'idx_ar_canalizaciones_estado');
            $table->index(['id_personal_responsable_destino'], 'idx_ar_canalizaciones_resp_destino');
            $table->index(['id_area_responsable_periodo_destino'], 'idx_ar_canalizaciones_area_resp_periodo');
        });

        Schema::table('ar_caso_canalizaciones', function (Blueprint $table) {
            $table->foreign(['id_ar_caso'], 'fk_ar_caso_canalizaciones_id_ar_caso')->references(['id_ar_caso'])->on('ar_casos_estudiantes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_destino'], 'fk_ar_caso_canalizaciones_id_area_destino')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_origen'], 'fk_ar_caso_canalizaciones_id_area_origen')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_responsable_horario_destino'], 'fk_ar_caso_canalizaciones_id_area_responsable_horario_destino')->references(['id_area_responsable_horario'])->on('ar_area_responsable_horarios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_responsable_periodo_destino'], 'fk_ar_caso_canalizaciones_id_area_responsable_periodo_destino')->references(['id_area_responsable_periodo'])->on('ar_area_responsables_periodo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_canaliza'], 'fk_ar_caso_canalizaciones_id_personal_canaliza')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_responsable_destino'], 'fk_ar_caso_canalizaciones_id_personal_responsable_destino')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_caso_canalizaciones');
    }
};
