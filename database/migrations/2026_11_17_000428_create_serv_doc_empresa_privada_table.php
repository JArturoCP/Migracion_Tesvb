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
        Schema::create('serv_doc_empresa_privada', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_empresa_privada', true);
            $table->integer('id_alumno');
            $table->text('pdf_carta_aceptacion');
            $table->integer('est_carta_aceptacion');
            $table->text('coment_carta_aceptacion');
            $table->text('pdf_anexo_tecnico');
            $table->integer('est_anexo_tecnico');
            $table->text('coment_anexo_tecnico');
            $table->text('pdf_curp');
            $table->integer('est_curp');
            $table->text('coment_curp');
            $table->text('pdf_carnet');
            $table->integer('est_carnet');
            $table->text('coment_carnet');
            $table->text('pdf_constancia_creditos');
            $table->integer('est_constancia_creditos');
            $table->text('coment_costancia_creditos');
            $table->text('pdf_solicitud_reg_autori');
            $table->integer('est_solicitud_reg_autori');
            $table->text('coment_solicitud_reg_autori');
            $table->integer('id_estado_documentacion');
            $table->string('fecha', 100);

            $table->primary(['id_empresa_privada']);
        });

        Schema::table('serv_doc_empresa_privada', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_serv_doc_empresa_privada_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_documentacion'], 'fk_serv_doc_empresa_privada_id_estado_documentacion')->references(['id_estado_documentacion'])->on('serv_estado_documentacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serv_doc_empresa_privada');
    }
};
