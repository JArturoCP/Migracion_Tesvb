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
        Schema::create('beca_numero_materias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_numero_materias', true);
            $table->integer('id_semestre');
            $table->integer('id_carrera');
            $table->integer('id_periodo');
            $table->integer('numero_materias');

            $table->primary(['id_numero_materias']);
        });

        Schema::table('beca_numero_materias', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_beca_numero_materias_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_beca_numero_materias_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_beca_numero_materias_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beca_numero_materias');
    }
};
