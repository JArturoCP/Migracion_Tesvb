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
        Schema::create('ti_equipos_computo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_equipo_computo', true);
            $table->integer('id_reg_dato_alum');
            $table->text('nombre_equipo');
            $table->text('descripcion');
            $table->text('folio_fiscal');
            $table->text('nombre_tienda');
            $table->text('fecha_registro');

            $table->primary(['id_equipo_computo']);
        });

        Schema::table('ti_equipos_computo', function (Blueprint $table) {
            $table->foreign(['id_reg_dato_alum'], 'fk_ti_equipos_computo_id_reg_dato_alum')->references(['id_reg_dato_alum'])->on('ti_reg_datos_alum')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_equipos_computo');
    }
};
