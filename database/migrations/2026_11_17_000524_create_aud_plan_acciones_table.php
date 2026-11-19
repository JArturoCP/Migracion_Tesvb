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
        Schema::create('aud_plan_acciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_plan_acciones', true);
            $table->integer('id_responsable')->nullable();
            $table->text('acciones')->nullable();
            $table->integer('id_responsable_implantar')->nullable();
            $table->date('fecha_implantar_accion')->nullable();
            $table->integer('id_responsable_revisar')->nullable();
            $table->date('fecha_verificacion')->nullable();
            $table->integer('id_evidencia')->nullable();
            $table->string('path_evidencia', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('estado')->nullable();
            $table->text('observaciones')->nullable();
            $table->date('fecha_planeada')->nullable();
            $table->integer('tipo')->nullable();
            $table->boolean('integrar_informe')->default(0);

            $table->primary(['id_plan_acciones']);
            $table->index(['integrar_informe'], 'idx_plan_integrar_informe');
        });

        Schema::table('aud_plan_acciones', function (Blueprint $table) {
            $table->foreign(['id_evidencia'], 'fk_aud_plan_acciones_id_evidencia')->references(['id_evidencia'])->on('aud_evidencias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_responsable'], 'fk_aud_plan_acciones_id_responsable')->references(['id_responsable'])->on('audresponsable_acciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_plan_acciones');
    }
};
