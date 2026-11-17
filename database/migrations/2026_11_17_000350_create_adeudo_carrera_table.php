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
        Schema::create('adeudo_carrera', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_adeudo_carrera', true);
            $table->integer('id_carrera');
            $table->integer('id_alumno');
            $table->integer('id_periodo');
            $table->text('comentario');

            $table->primary(['id_adeudo_carrera']);
        });

        Schema::table('adeudo_carrera', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_adeudo_carrera_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_adeudo_carrera_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_adeudo_carrera_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adeudo_carrera');
    }
};
