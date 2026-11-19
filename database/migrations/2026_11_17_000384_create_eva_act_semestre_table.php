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
        Schema::create('eva_act_semestre', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_act_semestre', true);
            $table->integer('id_periodo');
            $table->integer('id_alumno');
            $table->integer('semestre_actualizado');
            $table->string('fecha_actualizacion', 100);

            $table->primary(['id_act_semestre']);
        });

        Schema::table('eva_act_semestre', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_eva_act_semestre_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_eva_act_semestre_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_act_semestre');
    }
};
