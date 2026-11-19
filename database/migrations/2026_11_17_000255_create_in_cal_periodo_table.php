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
        Schema::create('in_cal_periodo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_cal_periodo', true);
            $table->date('fecha');
            $table->integer('id_unidad');
            $table->integer('id_periodo');
            $table->integer('id_nivel');
            $table->integer('id_grupo');
            $table->integer('evaluada');

            $table->primary(['id_cal_periodo']);
        });

        Schema::table('in_cal_periodo', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'fk_in_cal_periodo_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_in_cal_periodo_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_in_cal_periodo_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_cal_periodo');
    }
};
