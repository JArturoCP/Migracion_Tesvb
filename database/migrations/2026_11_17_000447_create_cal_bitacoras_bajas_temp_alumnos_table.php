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
        Schema::create('cal_bitacoras_bajas_temp_alumnos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_cal_bit_bajas', true);
            $table->integer('id_alumno')->nullable();
            $table->integer('id')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_cal_bit_bajas']);
            $table->index(['id'], 'fk_temp_carga');
            $table->index(['id_alumno'], 'fk_temp_alumno');
        });

        Schema::table('cal_bitacoras_bajas_temp_alumnos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_temp_alumno')->references(['id_alumno'])->on('gnral_alumnos');
            $table->foreign(['id'], 'fk_temp_carga')->references(['id'])->on('eva_validacion_de_cargas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_bitacoras_bajas_temp_alumnos');
    }
};
