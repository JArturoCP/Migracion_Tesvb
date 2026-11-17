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
        Schema::create('ti_requisitos_titulacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_requisitos', true);
            $table->integer('id_alumno');
            $table->integer('evi_acta_nac');
            $table->text('comentario_acta_nac');
            $table->text('pdf_acta_nac');
            $table->integer('estado_acta_nac');
            $table->integer('cal_acta_nac');
            $table->integer('evi_curp');
            $table->text('comentario_curp');
            $table->text('pdf_curp');
            $table->integer('estado_curp');
            $table->integer('cal_curp');
            $table->integer('evi_certificado_prep');
            $table->text('comentario_certificado_prep');
            $table->text('pdf_certificado_prep');
            $table->integer('estado_certificado_prep');
            $table->integer('cal_certificado_prep');
            $table->integer('evi_certificado_tesvb');
            $table->text('comentario_certificado_tesvb');
            $table->text('pdf_certificado_tesvb');
            $table->integer('estado_certificado_tesvb');
            $table->integer('cal_certificado_tesvb');
            $table->integer('evi_constancia_ss');
            $table->text('comentario_constancia_ss');
            $table->text('pdf_constancia_ss');
            $table->integer('estado_constancia_ss');
            $table->integer('cal_constancia_ss');
            $table->integer('evi_certificado_acred_ingles');
            $table->text('comentario_certificado_acred_ingles');
            $table->text('pdf_certificado_acred_ingles');
            $table->integer('estado_certificado_acred_ingles');
            $table->integer('cal_certificado_acred_ingles');
            $table->integer('evi_constancia_adeudo');
            $table->text('comentario_constancia_adeudo');
            $table->text('pdf_constancia_adeudo');
            $table->integer('estado_constancia_adeudo');
            $table->integer('id_opcion_titulacion');
            $table->integer('evi_opcion_titulacion');
            $table->text('comentario_opcion_titulacion');
            $table->text('pdf_opcion_titulacion');
            $table->integer('estado_opcion_titulacion');
            $table->integer('cal_opcion_titulacion');
            $table->text('correo_electronico');
            $table->integer('evi_reporte_result_egel');
            $table->text('comentario_reporte_result_egel');
            $table->text('pdf_reporte_result_egel');
            $table->integer('estado_reporte_result_egel');
            $table->integer('cal_reporte_result_egel');
            $table->integer('evi_pago_titulo');
            $table->text('comentario_pago_titulo');
            $table->text('pdf_pago_titulo');
            $table->integer('estado_pago_titulo');
            $table->integer('cal_pago_titulo');
            $table->integer('evi_pago_contancia');
            $table->text('comentario_pago_contancia');
            $table->text('pdf_pago_contancia');
            $table->integer('estado_pago_contancia');
            $table->integer('cal_pago_contancia');
            $table->integer('evi_pago_derecho_ti');
            $table->text('comentario_pago_derecho_ti');
            $table->text('pdf_pago_derecho_ti');
            $table->integer('estado_pago_derecho_ti');
            $table->integer('cal_pago_derecho_ti');
            $table->integer('evi_pago_integrante_jurado');
            $table->text('comentario_pago_integrante_jurado');
            $table->text('pdf_pago_integrante_jurado');
            $table->integer('estado_pago_integrante_jurado');
            $table->integer('cal_pago_integrante_jurado');
            $table->integer('evi_acta_residencia');
            $table->text('comentario_acta_residencia');
            $table->text('pdf_acta_residencia');
            $table->integer('estado_acta_residencia');
            $table->integer('cal_acta_residencia');
            $table->integer('evi_pago_concepto_autenticacion');
            $table->text('comentario_pago_concepto_autenticacion');
            $table->text('pdf_pago_concepto_autenticacion');
            $table->integer('estado_pago_concepto_autenticacion');
            $table->integer('cal_pago_concepto_autenticacion');
            $table->integer('id_estado_enviado');
            $table->text('fecha_registro');
            $table->integer('id_liberado_titulado');

            $table->primary(['id_requisitos']);
        });

        Schema::table('ti_requisitos_titulacion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_requisitos_titulacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_opcion_titulacion'], 'fk_ti_requisitos_titulacion_id_opcion_titulacion')->references(['id_opcion_titulacion'])->on('ti_opciones_titulacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_requisitos_titulacion');
    }
};
