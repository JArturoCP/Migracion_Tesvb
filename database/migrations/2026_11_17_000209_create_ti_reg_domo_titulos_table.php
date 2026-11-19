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
        Schema::create('ti_reg_domo_titulos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reg_domo', true);
            $table->string('abreviacion', 100);
            $table->integer('numero_inicial');
            $table->integer('numero_final');
            $table->string('fecha_reg', 100);
            $table->integer('id_registrado');
            $table->integer('id_estado_tomo');
            $table->string('fecha_activacion', 100);

            $table->primary(['id_reg_domo']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_reg_domo_titulos');
    }
};
