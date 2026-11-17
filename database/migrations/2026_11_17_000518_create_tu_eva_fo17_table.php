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
        Schema::create('tu_eva_fo17', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fo17', true);
            $table->integer('id_asigna_tutor');
            $table->integer('per');
            $table->integer('experiencia');
            $table->integer('anos_tutor');
            $table->integer('planeacion');
            $table->string('com_planeacion', 200);
            $table->date('fecha_establecida');
            $table->date('fecha_final');
            $table->integer('pregunta1');
            $table->integer('pregunta2');
            $table->integer('pregunta3');
            $table->integer('pregunta4');
            $table->integer('pregunta5');
            $table->integer('pregunta6');
            $table->integer('pregunta7');
            $table->integer('pregunta8');
            $table->integer('pregunta9');
            $table->integer('pregunta10');
            $table->string('comentario', 200);
            $table->timestamp('fecha_registro')->useCurrent();

            $table->primary(['id_fo17']);
        });

        Schema::table('tu_eva_fo17', function (Blueprint $table) {
            $table->foreign(['id_asigna_tutor'], 'fk_tu_eva_fo17_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_fo17');
    }
};
