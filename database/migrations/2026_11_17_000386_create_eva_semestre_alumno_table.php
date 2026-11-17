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
        Schema::create('eva_semestre_alumno', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_semestres_al', true);
            $table->integer('id_periodo');
            $table->integer('id_semestre');
            $table->integer('id_estado_autorizacion');
            $table->integer('id_alumno');
            $table->string('fecha_registro', 100);
            $table->string('fecha_mod', 100);
            $table->integer('id_usuario_mod');
            $table->string('datos_completos', 100);
            $table->integer('id_estado_rev');

            $table->primary(['id_semestres_al']);
        });

        Schema::table('eva_semestre_alumno', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_eva_semestre_alumno_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_eva_semestre_alumno_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_eva_semestre_alumno_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_semestre_alumno');
    }
};
