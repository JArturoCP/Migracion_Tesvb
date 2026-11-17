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
        Schema::create('gnral_periodo_carreras', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_periodo_carrera', true);
            $table->integer('id_carrera')->nullable();
            $table->integer('id_periodo')->nullable();

            $table->primary(['id_periodo_carrera']);
            $table->index(['id_periodo', 'id_carrera', 'id_periodo_carrera'], 'idx_gpc_periodo_carrera');
            $table->index(['id_periodo'], 'idx_periodo');
            $table->index(['id_carrera'], 'idx_carrera');
        });

        Schema::table('gnral_periodo_carreras', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_gnral_periodo_carreras_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_gnral_periodo_carreras_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_periodo_carreras');
    }
};
