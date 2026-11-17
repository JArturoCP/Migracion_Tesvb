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
        Schema::create('actualizar_creditos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_act_credito', true);
            $table->integer('id_alumno');
            $table->integer('id');
            $table->integer('credito_min');
            $table->integer('credito_max');

            $table->primary(['id_act_credito']);
            $table->index(['id_alumno'], 'id_alumno');
            $table->index(['id'], 'id');
        });

        Schema::table('actualizar_creditos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'actualizar_creditos_ibfk_1')->references(['id_alumno'])->on('gnral_alumnos');
            $table->foreign(['id'], 'actualizar_creditos_ibfk_2')->references(['id'])->on('eva_validacion_de_cargas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actualizar_creditos');
    }
};
