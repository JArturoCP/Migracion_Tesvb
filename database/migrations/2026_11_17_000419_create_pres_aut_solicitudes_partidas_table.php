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
        Schema::create('pres_aut_solicitudes_partidas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_solicitud_partida', true);
            $table->integer('id_solicitud');
            $table->integer('id_partida_pres');
            $table->integer('numero_requisicion');
            $table->integer('id_autorizacion');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);
            $table->double('presupuesto_dado');
            $table->double('importe_total');
            $table->integer('id_tipo_requisicion');
            $table->integer('id_actividades_req_ante');

            $table->primary(['id_solicitud_partida']);
        });

        Schema::table('pres_aut_solicitudes_partidas', function (Blueprint $table) {
            $table->foreign(['id_actividades_req_ante'], 'fk_pres_aut_solicitudes_partidas_id_actividades_req_ante')->references(['id_actividades_req_ante'])->on('pres_actividades_req_ante')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_partida_pres'], 'fk_pres_aut_solicitudes_partidas_id_partida_pres')->references(['id_partida_pres'])->on('pres_partida_pres')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_solicitud'], 'fk_pres_aut_solicitudes_partidas_id_solicitud')->references(['id_solicitud'])->on('pres_aut_solicitudes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_solicitudes_partidas');
    }
};
