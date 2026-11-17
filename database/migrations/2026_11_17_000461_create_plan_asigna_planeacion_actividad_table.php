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
        Schema::create('plan_asigna_planeacion_actividad', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_planeacion_actividad', true);
            $table->integer('id_asigna_generacion');
            $table->integer('id_plan_actividad');
            $table->text('comentario')->nullable();
            $table->integer('id_estado')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_planeacion_actividad']);
        });

        Schema::table('plan_asigna_planeacion_actividad', function (Blueprint $table) {
            $table->foreign(['id_asigna_generacion'], 'fk_plan_asigna_planeacion_actividad_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado'], 'fk_plan_asigna_planeacion_actividad_id_estado')->references(['id_estado'])->on('plan_estados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_plan_actividad'], 'fk_plan_asigna_planeacion_actividad_id_plan_actividad')->references(['id_plan_actividad'])->on('plan_actividades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_asigna_planeacion_actividad');
    }
};
