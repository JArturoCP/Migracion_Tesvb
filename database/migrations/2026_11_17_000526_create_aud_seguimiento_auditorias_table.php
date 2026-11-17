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
        Schema::create('aud_seguimiento_auditorias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_seguimiento', true);
            $table->integer('id_responsable');
            $table->integer('id_personal_seguimiento');
            $table->integer('asignado_por')->nullable();
            $table->timestamp('fecha_asignacion')->nullable()->useCurrent();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_seguimiento']);
            $table->index(['activo'], 'idx_seg_activo');
            $table->index(['id_responsable'], 'idx_seg_id_responsable');
            $table->index(['id_personal_seguimiento'], 'idx_seg_personal');
        });

        Schema::table('aud_seguimiento_auditorias', function (Blueprint $table) {
            $table->foreign(['id_personal_seguimiento'], 'fk_aud_seguimiento_auditorias_id_personal_seguimiento')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_responsable'], 'fk_aud_seguimiento_auditorias_id_responsable')->references(['id_responsable'])->on('audresponsable_acciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_seguimiento_auditorias');
    }
};
