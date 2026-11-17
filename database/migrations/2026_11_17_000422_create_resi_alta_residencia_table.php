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
        Schema::create('resi_alta_residencia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_alta_residencia', true);
            $table->integer('id_alumno');
            $table->integer('solicitud_residencia');
            $table->string('pdf_solicitud_residencia', 500);
            $table->text('comentario_solicitud_residencia');
            $table->integer('constancia_avance_academico');
            $table->string('pdf_constancia_avance_academico', 500);
            $table->text('comentario_constancia_avance_academico');
            $table->integer('comprobante_seguro');
            $table->string('pdf_comprobante_seguro', 500);
            $table->text('comentario_comprobante_seguro');
            $table->integer('oficio_asignacion_jefatura');
            $table->string('pdf_oficio_asignacion_jefatura', 500);
            $table->text('comentario_oficio_asignacion_jefatura');
            $table->integer('oficio_aceptacion_empresa');
            $table->string('pdf_oficio_aceptacion_empresa', 500);
            $table->text('comentario_oficio_aceptacion_empresa');
            $table->integer('oficio_presentacion_tecnologico');
            $table->string('pdf_oficio_presentacion_tecnologico', 500);
            $table->text('comentario_oficio_presentacion_tecnologico');
            $table->integer('anteproyecto');
            $table->string('pdf_anteproyecto', 500);
            $table->text('comentario_anteproyecto');
            $table->integer('carta_compromiso');
            $table->string('pdf_carta_compromiso', 500);
            $table->text('comentario_carta_compromiso');
            $table->integer('id_estado_convenio');
            $table->integer('convenio_empresa');
            $table->string('pdf_convenio_empresa', 500);
            $table->text('comentario_convenio_empresa');
            $table->integer('id_estado_solicitud');
            $table->string('correo', 100);
            $table->integer('id_periodo');

            $table->primary(['id_alta_residencia']);
        });

        Schema::table('resi_alta_residencia', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_resi_alta_residencia_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_resi_alta_residencia_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_alta_residencia');
    }
};
