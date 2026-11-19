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
        Schema::create('cal_servicio_social', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_servicio_social', true);
            $table->integer('id_alumno');
            $table->integer('calificacion');
            $table->string('fecha_termino', 100);
            $table->string('clave', 100);

            $table->primary(['id_servicio_social']);
            $table->unique(['id_alumno'], 'id_alumno_UNIQUE');
        });

        Schema::table('cal_servicio_social', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_cal_servicio_social_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_servicio_social');
    }
};
