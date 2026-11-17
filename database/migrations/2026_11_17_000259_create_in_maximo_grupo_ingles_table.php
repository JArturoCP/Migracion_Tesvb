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
        Schema::create('in_maximo_grupo_ingles', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_maximo_grupo_ingles', true);
            $table->integer('id_periodo_ingles');
            $table->string('num_maximo_alumnos', 200);

            $table->primary(['id_maximo_grupo_ingles']);
        });

        Schema::table('in_maximo_grupo_ingles', function (Blueprint $table) {
            $table->foreign(['id_periodo_ingles'], 'fk_in_maximo_grupo_ingles_id_periodo_ingles')->references(['id_periodo_ingles'])->on('in_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_maximo_grupo_ingles');
    }
};
