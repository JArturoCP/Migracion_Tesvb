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
        Schema::create('ti_reg_datos_alum', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reg_dato_alum', true);
            $table->text('correo_electronico');
            $table->integer('id_alumno');
            $table->text('fecha_emision_certificado');
            $table->text('fecha_reg_tramite_titulacion');
            $table->text('fecha_pag_derechos_titulacion');
            $table->string('no_cuenta', 100);
            $table->integer('id_tipo_estudiante');
            $table->text('nombre_al');
            $table->text('apaterno');
            $table->text('amaterno');
            $table->string('curp_al', 100);
            $table->integer('id_carrera');
            $table->integer('id_semestre');
            $table->integer('id_plan_estudio');
            $table->integer('promedio_general_tesvb');
            $table->integer('reprobacion_mat');
            $table->string('fecha_ingreso_tesvb', 100);
            $table->string('fecha_egreso_tesvb', 100);
            $table->integer('num_sem_cursados');
            $table->integer('id_opcion_titulacion');
            $table->text('nom_proyecto');
            $table->text('calle_domicilio');
            $table->text('numero_domicilio');
            $table->text('colonia_domicilio');
            $table->integer('municipio_domicilio');
            $table->integer('entidad_federativa');
            $table->string('telefono', 10);
            $table->integer('id_jefe_division');
            $table->text('nom_empresa');
            $table->integer('id_red_social');
            $table->text('nombre_usuario_red');
            $table->integer('id_tipo_donacion');
            $table->integer('presenta_discapacidad');
            $table->text('discapacidad_que_presenta');
            $table->integer('lengua_indigena');
            $table->text('habla_lengua_indigena');
            $table->integer('mencion_honorifica');
            $table->integer('id_nacionalidad');
            $table->string('fecha_ingreso_preparatoria', 100);
            $table->string('fecha_egreso_preparatoria', 100);
            $table->integer('id_estado_enviado');
            $table->timestamp('fecha_registro')->useCurrent()->useCurrentOnUpdate();
            $table->text('fecha_envio');
            $table->text('comentario');
            $table->integer('id_enviado_biblioteca');
            $table->text('nombre_jefe_division');
            $table->string('sexo_jefe_division', 10);
            $table->text('nombre_director_general');
            $table->string('sexo_director_general', 10);
            $table->text('nombre_director_academico');
            $table->string('sexo_director_academico', 10);
            $table->text('nombre_subdirector_servicios');
            $table->string('sexo_subdirector_servicios', 10);
            $table->text('nombre_jefe_titulacion');
            $table->string('sexo_jefe_titulacion', 10);
            $table->text('nombre_jefe_personal');
            $table->string('sexo_jefe_personal', 10);
            $table->text('nombre_jefe_recursos');
            $table->string('sexo_jefe_recursos', 10);
            $table->integer('id_liberado_titulado');

            $table->primary(['id_reg_dato_alum']);
        });

        Schema::table('ti_reg_datos_alum', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_reg_datos_alum_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_ti_reg_datos_alum_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_nacionalidad'], 'fk_ti_reg_datos_alum_id_nacionalidad')->references(['id_nacionalidad'])->on('ti_nacionalidad')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_opcion_titulacion'], 'fk_ti_reg_datos_alum_id_opcion_titulacion')->references(['id_opcion_titulacion'])->on('ti_opciones_titulacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_plan_estudio'], 'fk_ti_reg_datos_alum_id_plan_estudio')->references(['id_plan_estudio'])->on('ti_planes_estudios')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_red_social'], 'fk_ti_reg_datos_alum_id_red_social')->references(['id_red_social'])->on('ti_redes_sociales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_ti_reg_datos_alum_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_donacion'], 'fk_ti_reg_datos_alum_id_tipo_donacion')->references(['id_tipo_donacion'])->on('ti_tipos_donacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_estudiante'], 'fk_ti_reg_datos_alum_id_tipo_estudiante')->references(['id_tipo_estudiante'])->on('ti_tipo_estudiante')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_reg_datos_alum');
    }
};
