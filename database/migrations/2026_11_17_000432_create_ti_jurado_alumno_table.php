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
        Schema::create('ti_jurado_alumno', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_jurado_alumno', true);
            $table->integer('id_alumno');
            $table->integer('id_tipo_jurado');
            $table->text('fecha_registro');
            $table->integer('id_personal');

            $table->primary(['id_jurado_alumno']);
        });

        Schema::table('ti_jurado_alumno', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_jurado_alumno_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_ti_jurado_alumno_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_jurado'], 'fk_ti_jurado_alumno_id_tipo_jurado')->references(['id_tipo_jurado'])->on('ti_tipo_jurado')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_jurado_alumno');
    }
};
