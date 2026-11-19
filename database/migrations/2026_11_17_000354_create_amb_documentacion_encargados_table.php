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
        Schema::create('amb_documentacion_encargados', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_documentacion_encar', true);
            $table->integer('id_encargado');
            $table->integer('id_periodo_amb');
            $table->integer('solic_estado_acc_m1');
            $table->integer('evi_estado_acc_m1');
            $table->integer('estado_estado_acc_m1');
            $table->text('pdf_estado_acc_m1');
            $table->text('comentario_estado_acc_m1');
            $table->integer('cal_estado_acc_m1');
            $table->integer('solic_cuestion_ambas_per_m2');
            $table->integer('evi_cuestion_ambas_per_m2');
            $table->integer('estado_cuestion_ambas_per_m2');
            $table->text('pdf_cuestion_ambas_per_m2');
            $table->text('comentario_cuestion_ambas_per_m2');
            $table->integer('cal_cuestion_ambas_per_m2');
            $table->integer('solic_necesidades_espectativas_m2');
            $table->integer('evi_necesidades_espectativas_m2');
            $table->integer('estado_necesidades_espectativas_m2');
            $table->text('pdf_necesidades_espectativas_m2');
            $table->text('comentario_necesidades_espectativas_m2');
            $table->integer('cal_necesidades_espectativas_m2');
            $table->integer('solic_aspecto_ambiental_m2');
            $table->integer('evi_aspecto_ambiental_m2');
            $table->integer('estado_aspecto_ambiental_m2');
            $table->text('pdf_aspecto_ambiental_m2');
            $table->text('comentario_aspecto_ambiental_m2');
            $table->integer('cal_aspecto_ambiental_m2');
            $table->integer('solic_riesgo_oportu_m2');
            $table->integer('evi_riesgo_oportu_m2');
            $table->integer('estado_riesgo_oportu_m2');
            $table->text('pdf_riesgo_oportu_m2');
            $table->text('comentario_riesgo_oportu_m2');
            $table->integer('cal_riesgo_oportu_m2');
            $table->integer('solic_grado_objetivo_m3');
            $table->integer('evi_grado_objetivo_m3');
            $table->integer('estado_grado_objetivo_m3');
            $table->text('pdf_grado_objetivo_m3');
            $table->text('comentario_grado_objetivo_m3');
            $table->integer('cal_grado_objetivo_m3');
            $table->integer('solic_programa_gestion_m3');
            $table->integer('evi_programa_gestion_m3');
            $table->integer('estado_programa_gestion_m3');
            $table->text('pdf_programa_gestion_m3');
            $table->text('comentario_programa_gestion_m3');
            $table->integer('cal_programa_gestion_m3');
            $table->integer('solic_noconformid_correctivas_m4');
            $table->integer('evi_noconformid_correctivas_m4');
            $table->integer('estado_noconformid_correctivas_m4');
            $table->text('pdf_noconformid_correctivas_m4');
            $table->text('comentario_noconformid_correctivas_m4');
            $table->integer('cal_noconformid_correctivas_m4');
            $table->integer('solic_resu_seg_med_m4');
            $table->integer('evi_resu_seg_med_m4');
            $table->integer('estado_resu_seg_med_m4');
            $table->text('pdf_resu_seg_med_m4');
            $table->text('comentario_resu_seg_med_m4');
            $table->integer('cal_resu_seg_med_m4');
            $table->integer('solic_cumplimiento_req_m4');
            $table->integer('evi_cumplimiento_req_m4');
            $table->integer('estado_cumplimiento_req_m4');
            $table->text('pdf_cumplimiento_req_m4');
            $table->text('comentario_cumplimiento_req_m4');
            $table->integer('cal_cumplimiento_req_m4');
            $table->integer('solic_resultado_audi_m4');
            $table->integer('evi_resultado_audi_m4');
            $table->integer('estado_resultado_audi_m4');
            $table->text('pdf_resultado_audi_m4');
            $table->text('comentario_resultado_audi_m4');
            $table->integer('cal_resultado_audi_m4');
            $table->integer('solic_adecuacion_recurso_m5');
            $table->integer('evi_adecuacion_recurso_m5');
            $table->integer('estado_adecuacion_recurso_m5');
            $table->text('pdf_adecuacion_recurso_m5');
            $table->text('comentario_adecuacion_recurso_m5');
            $table->integer('cal_adecuacion_recurso_m5');
            $table->integer('solic_comunicacion_pertinente_m6');
            $table->integer('evi_comunicacion_pertinente_m6');
            $table->integer('estado_comunicacion_pertinente_m6');
            $table->text('pdf_comunicacion_pertinente_m6');
            $table->text('comentario_comunicacion_pertinente_m6');
            $table->integer('cal_comunicacion_pertinente_m6');
            $table->integer('solic_oportunidades_mejora_m7');
            $table->integer('evi_oportunidades_mejora_m7');
            $table->integer('estado_oportunidades_mejora_m7');
            $table->text('pdf_oportunidades_mejora_m7');
            $table->text('comentario_oportunidades_mejora_m7');
            $table->integer('cal_oportunidades_mejora_m7');
            $table->integer('estado_envio_doc');
            $table->text('fecha_registro');

            $table->primary(['id_documentacion_encar']);
        });

        Schema::table('amb_documentacion_encargados', function (Blueprint $table) {
            $table->foreign(['id_encargado'], 'fk_amb_documentacion_encargados_id_encargado')->references(['id_encargado'])->on('amb_encargados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_amb'], 'fk_amb_documentacion_encargados_id_periodo_amb')->references(['id_periodo_amb'])->on('amb_periodo_amb')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amb_documentacion_encargados');
    }
};
