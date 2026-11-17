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
        Schema::create('pres_aut_presupuesto_aut', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_presupuesto_aut', true);
            $table->integer('year_presupuesto');
            $table->integer('id_partida');
            $table->double('total_presupuesto');
            $table->double('enero_pres');
            $table->double('febrero_pres');
            $table->double('marzo_pres');
            $table->double('abril_pres');
            $table->double('mayo_pres');
            $table->double('junio_pres');
            $table->double('julio_pres');
            $table->double('agosto_pres');
            $table->double('septiembre_pres');
            $table->double('octubre_pres');
            $table->double('noviembre_pres');
            $table->double('diciembre_pres');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_presupuesto_aut']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_presupuesto_aut');
    }
};
