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
        Schema::create('in_hrs_ingles_profesor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_hrs_ingles_profesor', true);
            $table->integer('id_profesor');
            $table->integer('id_grupo');
            $table->integer('id_nivel');
            $table->integer('id_periodo');
            $table->integer('id_estado');
            $table->string('fecha_activacion', 100);

            $table->primary(['id_hrs_ingles_profesor']);
            $table->index(['id_periodo', 'id_nivel', 'id_grupo'], 'idx_hrs_periodo_nivel_grupo');
            $table->index(['id_periodo', 'id_grupo', 'id_nivel'], 'idx_hrs_periodo_grupo_nivel');
        });

        Schema::table('in_hrs_ingles_profesor', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'fk_in_hrs_ingles_profesor_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_in_hrs_ingles_profesor_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_hrs_ingles_profesor');
    }
};
