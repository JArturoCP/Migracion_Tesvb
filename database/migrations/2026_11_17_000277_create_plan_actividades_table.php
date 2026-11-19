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
        Schema::create('plan_actividades', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_plan_actividad', true);
            $table->text('desc_actividad');
            $table->text('objetivo_actividad');
            $table->date('fi_actividad');
            $table->date('ff_actividad');
            $table->integer('id_generacion');
            $table->integer('id_periodo');
            $table->text('comentario');
            $table->integer('id_estado');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_plan_actividad']);
        });

        Schema::table('plan_actividades', function (Blueprint $table) {
            $table->foreign(['id_estado'], 'fk_plan_actividades_id_estado')->references(['id_estado'])->on('plan_estados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_generacion'], 'fk_plan_actividades_id_generacion')->references(['id_generacion'])->on('exp_generacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_plan_actividades_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_actividades');
    }
};
