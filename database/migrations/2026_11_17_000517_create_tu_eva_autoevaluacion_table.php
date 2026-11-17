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
        Schema::create('tu_eva_autoevaluacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eva_autoevaluacion', true);
            $table->dateTime('fecha_de_registro');
            $table->integer('id_asigna_tutor');
            $table->integer('id_eva_tiempo_tutor');
            $table->double('satisfacion');
            $table->double('necesidades');
            $table->double('factores');
            $table->string('comentario', 200);

            $table->primary(['id_eva_autoevaluacion']);
        });

        Schema::table('tu_eva_autoevaluacion', function (Blueprint $table) {
            $table->foreign(['id_asigna_tutor'], 'fk_tu_eva_autoevaluacion_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_eva_tiempo_tutor'], 'fk_tu_eva_autoevaluacion_id_eva_tiempo_tutor')->references(['id_eva_tiempo_tutor'])->on('tu_eva_tiempo_tutor')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_autoevaluacion');
    }
};
