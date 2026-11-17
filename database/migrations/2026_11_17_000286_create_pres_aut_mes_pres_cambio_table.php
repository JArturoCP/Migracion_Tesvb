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
        Schema::create('pres_aut_mes_pres_cambio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_mes_pres_cambio', true);
            $table->integer('id_presupuesto_aut_copia');
            $table->integer('id_partida');
            $table->integer('id_mes');
            $table->double('cambio_presupuesto');
            $table->integer('id_mes_cambio');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificar', 100);

            $table->primary(['id_mes_pres_cambio']);
        });

        Schema::table('pres_aut_mes_pres_cambio', function (Blueprint $table) {
            $table->foreign(['id_mes'], 'fk_pres_aut_mes_pres_cambio_id_mes')->references(['id_mes'])->on('pres_mes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_presupuesto_aut_copia'], 'fk_pres_aut_mes_pres_cambio_id_presupuesto_aut_copia')->references(['id_presupuesto_aut_copia'])->on('pres_aut_presupuesto_aut_copia')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_mes_pres_cambio');
    }
};
