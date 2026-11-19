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
        Schema::create('cal_duales_actuales', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_duales_actuales', true);
            $table->integer('id_periodo');
            $table->integer('id_alumno');
            $table->integer('id_estado');
            $table->integer('id_personal');

            $table->primary(['id_duales_actuales']);
        });

        Schema::table('cal_duales_actuales', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_cal_duales_actuales_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_cal_duales_actuales_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_cal_duales_actuales_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_duales_actuales');
    }
};
