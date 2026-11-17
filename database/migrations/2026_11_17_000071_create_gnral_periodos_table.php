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
        Schema::create('gnral_periodos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_periodo', true);
            $table->string('periodo', 50)->nullable();
            $table->date('fecha_inicio');
            $table->date('fecha_termino');
            $table->string('ciclo', 30);
            $table->integer('year');
            $table->string('siglas', 100);
            $table->integer('estado');

            $table->primary(['id_periodo']);
            $table->index(['estado', 'year', 'id_periodo'], 'idx_ar_periodos_estado_year');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_periodos');
    }
};
