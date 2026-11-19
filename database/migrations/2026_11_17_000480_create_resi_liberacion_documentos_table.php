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
        Schema::create('resi_liberacion_documentos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_liberacion_documentos', true);
            $table->integer('id_anteproyecto');
            $table->integer('id_periodo');
            $table->text('correo_electronico');
            $table->integer('estado_acta_calificacion');
            $table->text('pdf_acta_calificacion');
            $table->text('comentario_acta_calificacion');
            $table->integer('estado_portada');
            $table->text('pdf_portada');
            $table->text('comentario_portada');
            $table->integer('estado_evaluacion_final_residencia');
            $table->text('pdf_evaluacion_final_residencia');
            $table->text('comentario_evaluacion_final_residencia');
            $table->integer('estado_oficio_aceptacion_informe_interno');
            $table->text('pdf_oficio_aceptacion_informe_interno');
            $table->text('comentario_oficio_aceptacion_informe_interno');
            $table->integer('estado_formato_evaluacion');
            $table->text('pdf_formato_evaluacion');
            $table->text('comentario_formato_evaluacion');
            $table->integer('estado_oficio_aceptacion_informe_revisor');
            $table->text('pdf_oficio_aceptacion_informe_revisor');
            $table->text('comentario_oficio_aceptacion_informe_revisor');
            $table->integer('estado_oficio_aceptacion_informe_externo');
            $table->text('pdf_oficio_aceptacion_informe_externo');
            $table->text('comentario_oficio_aceptacion_informe_externo');
            $table->integer('estado_formato_hora');
            $table->text('pdf_formato_hora');
            $table->text('comentario_formato_hora');
            $table->integer('estado_seguimiento_interno');
            $table->text('pdf_seguimiento_interno');
            $table->text('comentario_seguimiento_interno');
            $table->integer('estado_seguimiento_externo');
            $table->text('pdf_seguimiento_externo');
            $table->text('comentario_seguimiento_externo');
            $table->integer('estado_proyecto');
            $table->text('comentario_proyecto');
            $table->integer('id_estado_enviado');

            $table->primary(['id_liberacion_documentos']);
        });

        Schema::table('resi_liberacion_documentos', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_liberacion_documentos_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_resi_liberacion_documentos_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_liberacion_documentos');
    }
};
