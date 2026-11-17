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
        Schema::create('pres_actividades_req_ante', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_actividades_req_ante', true);
            $table->integer('id_req_mat_ante');
            $table->integer('id_partida_pres');
            $table->integer('id_mes');
            $table->integer('id_proyecto');
            $table->integer('id_meta');
            $table->integer('numero_requisicion');
            $table->text('justificacion');
            $table->text('cotizacion_pdf');
            $table->integer('id_autorizacion');
            $table->text('comentario');
            $table->text('requisicion_pdf');
            $table->text('anexo_1_pdf');
            $table->text('oficio_suficiencia_presupuestal_pdf');
            $table->integer('id_estado_justificacion');
            $table->text('justificacion_pdf');
            $table->string('fecha_reg', 100);
            $table->string('fecha_mod', 100);

            $table->primary(['id_actividades_req_ante']);
        });

        Schema::table('pres_actividades_req_ante', function (Blueprint $table) {
            $table->foreign(['id_mes'], 'fk_pres_actividades_req_ante_id_mes')->references(['id_mes'])->on('pres_mes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_meta'], 'fk_pres_actividades_req_ante_id_meta')->references(['id_meta'])->on('pres_metas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_partida_pres'], 'fk_pres_actividades_req_ante_id_partida_pres')->references(['id_partida_pres'])->on('pres_partida_pres')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_proyecto'], 'fk_pres_actividades_req_ante_id_proyecto')->references(['id_proyecto'])->on('pres_proyectos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_req_mat_ante'], 'fk_pres_actividades_req_ante_id_req_mat_ante')->references(['id_req_mat_ante'])->on('pres_req_mat_ante')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_actividades_req_ante');
    }
};
