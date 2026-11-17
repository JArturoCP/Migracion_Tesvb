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
        Schema::create('resi_encuesta_residencia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_encuesta', true);
            $table->integer('id_anteproyecto');
            $table->string('pregunta1', 11);
            $table->string('pregunta2', 11);
            $table->string('pregunta3', 11);
            $table->string('pregunta4', 11);
            $table->string('pregunta5', 11);
            $table->string('pregunta6', 11);
            $table->string('pregunta7', 11);
            $table->text('comentario');
            $table->text('pregunta8');
            $table->string('pregunta9', 10);

            $table->primary(['id_encuesta']);
        });

        Schema::table('resi_encuesta_residencia', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_encuesta_residencia_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_encuesta_residencia');
    }
};
