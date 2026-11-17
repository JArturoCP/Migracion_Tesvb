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
        Schema::create('aud_seguimiento_acciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_seguimiento_accion', true);
            $table->integer('id_plan_acciones');
            $table->integer('id_responsable');
            $table->integer('id_personal_seguimiento');
            $table->text('nota_seguimiento')->nullable();
            $table->tinyInteger('estado_cumplimiento', false, true)->default(0);
            $table->timestamp('fecha_revision')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_seguimiento_accion']);
            $table->index(['estado_cumplimiento'], 'idx_seg_accion_estado');
            $table->index(['id_personal_seguimiento'], 'idx_seg_accion_personal');
            $table->index(['id_plan_acciones'], 'idx_seg_accion_plan');
            $table->index(['id_responsable'], 'idx_seg_accion_responsable');
        });

        Schema::table('aud_seguimiento_acciones', function (Blueprint $table) {
            $table->foreign(['id_personal_seguimiento'], 'fk_aud_seguimiento_acciones_id_personal_seguimiento')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_plan_acciones'], 'fk_aud_seguimiento_acciones_id_plan_acciones')->references(['id_plan_acciones'])->on('aud_plan_acciones')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_responsable'], 'fk_aud_seguimiento_acciones_id_responsable')->references(['id_responsable'])->on('audresponsable_acciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_seguimiento_acciones');
    }
};
