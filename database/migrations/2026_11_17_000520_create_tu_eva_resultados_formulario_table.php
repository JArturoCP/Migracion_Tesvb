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
        Schema::create('tu_eva_resultados_formulario', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eva_resultado', true);
            $table->integer('id_asigna_alumno');
            $table->integer('id_asigna_tutor');
            $table->dateTime('feccha_de_registro')->nullable();
            $table->integer('gestion');
            $table->integer('actitud');
            $table->integer('disponibilidad_confianza');
            $table->integer('servicios_del_programa_de_tutoria');
            $table->integer('tus_logros_y_avances');
            $table->string('comentario', 300);

            $table->primary(['id_eva_resultado']);
        });

        Schema::table('tu_eva_resultados_formulario', function (Blueprint $table) {
            $table->foreign(['id_asigna_alumno'], 'fk_tu_eva_resultados_formulario_id_asigna_alumno')->references(['id_asigna_alumno'])->on('exp_asigna_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_asigna_tutor'], 'fk_tu_eva_resultados_formulario_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_resultados_formulario');
    }
};
