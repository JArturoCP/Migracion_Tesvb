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
        Schema::create('ti_fecha_jurado_alumn', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fecha_jurado_alumn', true);
            $table->text('fecha_titulacion');
            $table->integer('id_horarios_dias');
            $table->integer('id_sala');
            $table->integer('id_alumno');
            $table->text('fecha_registro');
            $table->integer('id_estado_enviado');
            $table->text('comentario');
            $table->text('oficio_noti_jurado_jefe');
            $table->text('fecha_oficio_noti_jurado_jefe');
            $table->integer('id_oficio_noti_jurado_jefe');
            $table->text('oficio_noti_jurado_estudiante');
            $table->text('fecha_oficio_noti_jurado_estudiante');
            $table->integer('id_oficio_noti_jurado_estudiante');
            $table->text('carta_compromiso');
            $table->text('mencion_honorifica');
            $table->text('fecha_mencion_honorifica');
            $table->integer('id_mencion_honorifica');
            $table->integer('revisor');
            $table->integer('asesor');
            $table->text('pdf_reporte_titulacion');
            $table->integer('id_autorizar_agendar_jurado');
            $table->integer('id_liberado_titulado');

            $table->primary(['id_fecha_jurado_alumn']);
        });

        Schema::table('ti_fecha_jurado_alumn', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_fecha_jurado_alumn_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_horarios_dias'], 'fk_ti_fecha_jurado_alumn_id_horarios_dias')->references(['id_horarios_dias'])->on('ti_horarios_dias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_mencion_honorifica'], 'fk_ti_fecha_jurado_alumn_id_mencion_honorifica')->references(['id_mencion_honorifica'])->on('ti_mencion_honorifica')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_sala'], 'fk_ti_fecha_jurado_alumn_id_sala')->references(['id_sala'])->on('ti_sala')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_fecha_jurado_alumn');
    }
};
