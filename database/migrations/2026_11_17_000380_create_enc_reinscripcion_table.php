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
        Schema::create('enc_reinscripcion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reinscripcion', true);
            $table->integer('id_alumno');
            $table->integer('id_carrera');
            $table->integer('id_tipo_encuesta');
            $table->string('fecha_encuesta', 100);
            $table->integer('cal_preg_1');
            $table->integer('cal_preg_2');
            $table->integer('cal_preg_3');
            $table->integer('cal_preg_4');
            $table->integer('cal_preg_5');
            $table->integer('cal_preg_6');
            $table->integer('cal_preg_7');
            $table->integer('cal_preg_8');
            $table->integer('cal_preg_9');
            $table->integer('cal_preg_10');
            $table->text('comentario_res_preg_10');
            $table->integer('cal_preg_11');
            $table->text('comentario');
            $table->integer('id_periodo');
            $table->string('fecha_registro', 100);
            $table->integer('id_estado');

            $table->primary(['id_reinscripcion']);
        });

        Schema::table('enc_reinscripcion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_enc_reinscripcion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_enc_reinscripcion_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_enc_reinscripcion_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_encuesta'], 'fk_enc_reinscripcion_id_tipo_encuesta')->references(['id_tipo_encuesta'])->on('enc_tipos_encuestas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_reinscripcion');
    }
};
