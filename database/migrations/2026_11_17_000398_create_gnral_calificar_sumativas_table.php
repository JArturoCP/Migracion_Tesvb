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
        Schema::create('gnral_calificar_sumativas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_calificar_sumativas', true);
            $table->integer('id_materia');
            $table->integer('id_grupo');
            $table->integer('id_estado');
            $table->integer('id_periodo');
            $table->string('fecha', 100);

            $table->primary(['id_calificar_sumativas']);
        });

        Schema::table('gnral_calificar_sumativas', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'fk_gnral_calificar_sumativas_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_materia'], 'fk_gnral_calificar_sumativas_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_gnral_calificar_sumativas_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_calificar_sumativas');
    }
};
