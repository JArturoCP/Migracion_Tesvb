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
        Schema::create('amb_periodo_amb', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_periodo_amb', true);
            $table->text('nombre_periodo_amb');
            $table->integer('fecha_an');
            $table->integer('fecha_mes');
            $table->integer('estado_periodo');
            $table->string('fecha_registro', 100);

            $table->primary(['id_periodo_amb']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amb_periodo_amb');
    }
};
