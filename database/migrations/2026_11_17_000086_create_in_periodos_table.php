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
        Schema::create('in_periodos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_periodo_ingles', true);
            $table->text('periodo_ingles');
            $table->date('fecha_inicio_ingles');
            $table->date('fecha_final_ingles');
            $table->date('fecha_inicial_periodo');
            $table->date('fecha_final_periodo');
            $table->integer('estado_actual');
            $table->integer('estado_historial');

            $table->primary(['id_periodo_ingles']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_periodos');
    }
};
