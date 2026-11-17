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
        Schema::create('cal_actividades_complementarias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_actividades_comple', true);
            $table->string('clave', 100);
            $table->integer('id_alumno');
            $table->string('cal', 100);

            $table->primary(['id_actividades_comple']);
        });

        Schema::table('cal_actividades_complementarias', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_cal_actividades_complementarias_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_actividades_complementarias');
    }
};
