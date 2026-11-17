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
        Schema::create('tu_eva_formulario_tutor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eva_formulario_tutor', true);
            $table->dateTime('fecha_de_registro');
            $table->integer('id_asigna_tutor');
            $table->integer('id_eva_cuestionario');
            $table->integer('calificacion');

            $table->primary(['id_eva_formulario_tutor']);
        });

        Schema::table('tu_eva_formulario_tutor', function (Blueprint $table) {
            $table->foreign(['id_asigna_tutor'], 'fk_tu_eva_formulario_tutor_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_eva_cuestionario'], 'fk_tu_eva_formulario_tutor_id_eva_cuestionario')->references(['id_eva_cuestionario'])->on('tu_eva_cuestionario')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_formulario_tutor');
    }
};
