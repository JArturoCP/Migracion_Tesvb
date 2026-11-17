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
        Schema::create('pres_aut_solicitudes_documentos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_solicitud_documento', true);
            $table->integer('id_solicitud');
            $table->string('cotizacion_pdf', 100);
            $table->string('requisicion_pdf', 100);
            $table->string('anexo_1_pdf', 100);
            $table->string('oficio_suficiencia_presupuestal_pdf', 100);
            $table->integer('id_estado_justificacion');
            $table->string('oficio_justificacion', 100);
            $table->text('comentario');
            $table->integer('id_autorizacion');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);
            $table->integer('id_tipo_contrato');
            $table->text('pdf_tipo_contrato');
            $table->text('pdf_factura_comprado');
            $table->text('pdf_pago_material_comprado');
            $table->text('pdf_oficio_entrega');
            $table->text('pdf_solicitud_pago');

            $table->primary(['id_solicitud_documento']);
        });

        Schema::table('pres_aut_solicitudes_documentos', function (Blueprint $table) {
            $table->foreign(['id_solicitud'], 'fk_pres_aut_solicitudes_documentos_id_solicitud')->references(['id_solicitud'])->on('pres_aut_solicitudes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_contrato'], 'fk_pres_aut_solicitudes_documentos_id_tipo_contrato')->references(['id_tipo_contrato'])->on('pres_aut_tipo_contrato')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_solicitudes_documentos');
    }
};
