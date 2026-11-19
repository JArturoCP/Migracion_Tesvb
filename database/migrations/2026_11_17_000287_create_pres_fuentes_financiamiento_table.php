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
        Schema::create('pres_fuentes_financiamiento', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fuente_financiamiento', true);
            $table->integer('id_presupuesto_ante');
            $table->integer('id_capitulo');
            $table->double('presupuesto_estatal');
            $table->double('presupuesto_federal');
            $table->double('presupuesto_propios');
            $table->double('total_presupuesto');
            $table->double('financiamiento_estatal');
            $table->double('financiamiento_federal');
            $table->double('financiamiento_propios');
            $table->double('total_financiamiento');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_fuente_financiamiento']);
        });

        Schema::table('pres_fuentes_financiamiento', function (Blueprint $table) {
            $table->foreign(['id_capitulo'], 'fk_pres_fuentes_financiamiento_id_capitulo')->references(['id_capitulo'])->on('pres_capitulos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_fuentes_financiamiento');
    }
};
