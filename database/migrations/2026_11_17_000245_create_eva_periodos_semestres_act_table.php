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
        Schema::create('eva_periodos_semestres_act', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_periodos_sem_act', true);
            $table->integer('id_periodo');
            $table->integer('id_estado_actualizacion');
            $table->string('fecha_registro', 100);
            $table->string('fecha_actualizacion', 100);

            $table->primary(['id_periodos_sem_act']);
        });

        Schema::table('eva_periodos_semestres_act', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_eva_periodos_semestres_act_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_periodos_semestres_act');
    }
};
