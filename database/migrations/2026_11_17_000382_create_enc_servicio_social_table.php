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
        Schema::create('enc_servicio_social', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_servicio', true);
            $table->integer('id_tipo_encuesta');
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
            $table->text('comentario');
            $table->integer('id_alumno');
            $table->text('fecha_encuesta');
            $table->integer('id_estado');
            $table->integer('mes');
            $table->integer('year');
            $table->text('fecha_registro');

            $table->primary(['id_servicio']);
        });

        Schema::table('enc_servicio_social', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_enc_servicio_social_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_encuesta'], 'fk_enc_servicio_social_id_tipo_encuesta')->references(['id_tipo_encuesta'])->on('enc_tipos_encuestas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_servicio_social');
    }
};
