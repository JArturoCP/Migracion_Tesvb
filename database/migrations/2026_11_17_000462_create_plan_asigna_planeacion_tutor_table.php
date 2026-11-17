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
        Schema::create('plan_asigna_planeacion_tutor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_planeacion_tutor', true);
            $table->integer('id_plan_actividad');
            $table->integer('id_asigna_generacion');
            $table->integer('id_estrategia');
            $table->text('estrategia');
            $table->integer('requiere_evidencia')->nullable();
            $table->integer('boton');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_planeacion_tutor']);
        });

        Schema::table('plan_asigna_planeacion_tutor', function (Blueprint $table) {
            $table->foreign(['id_asigna_generacion'], 'fk_plan_asigna_planeacion_tutor_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_plan_actividad'], 'fk_plan_asigna_planeacion_tutor_id_plan_actividad')->references(['id_plan_actividad'])->on('plan_actividades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_asigna_planeacion_tutor');
    }
};
