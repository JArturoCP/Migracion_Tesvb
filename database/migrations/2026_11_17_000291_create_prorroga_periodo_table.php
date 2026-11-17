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
        Schema::create('prorroga_periodo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_prorroga_periodo', true);
            $table->date('fecha_inicial');
            $table->date('fecha_final');
            $table->integer('id_periodo');
            $table->text('fecha_ultima');
            $table->date('fecha_ult_num');

            $table->primary(['id_prorroga_periodo']);
        });

        Schema::table('prorroga_periodo', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_prorroga_periodo_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prorroga_periodo');
    }
};
