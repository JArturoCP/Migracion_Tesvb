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
        Schema::create('enc_titulacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_titulacion', true);
            $table->integer('id_alumno');
            $table->integer('id_carrera');
            $table->integer('id_tipo_encuesta');
            $table->text('fecha_encuesta');
            $table->integer('resp_preg4');
            $table->integer('resp_preg5');
            $table->integer('resp_preg6');
            $table->integer('resp_preg7');
            $table->integer('resp_preg8');
            $table->integer('resp_preg9');
            $table->integer('resp_preg10');
            $table->integer('resp_preg11');
            $table->integer('resp_preg12');
            $table->integer('resp_preg13');
            $table->integer('resp_preg14');
            $table->integer('resp_preg15');
            $table->integer('resp_preg16');
            $table->integer('resp_preg17');
            $table->integer('resp_preg18');
            $table->text('comentario_adicional');
            $table->integer('id_estado');
            $table->text('fecha_registro');
            $table->integer('mes');
            $table->integer('year');

            $table->primary(['id_titulacion']);
        });

        Schema::table('enc_titulacion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_enc_titulacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_enc_titulacion_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_encuesta'], 'fk_enc_titulacion_id_tipo_encuesta')->references(['id_tipo_encuesta'])->on('enc_tipos_encuestas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_titulacion');
    }
};
