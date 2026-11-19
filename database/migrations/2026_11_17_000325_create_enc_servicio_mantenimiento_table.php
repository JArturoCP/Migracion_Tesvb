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
        Schema::create('enc_servicio_mantenimiento', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_servicio_mantenimiento', true);
            $table->integer('id_tipo_encuesta');
            $table->text('servicio_solicita');
            $table->integer('id_personal');
            $table->date('fecha_solicita');
            $table->text('fecha_encuesta');
            $table->integer('cal_preg_1');
            $table->integer('cal_preg_2');
            $table->integer('cal_preg_3');
            $table->integer('cal_preg_4');
            $table->integer('year');
            $table->integer('mes');
            $table->integer('id_estado');
            $table->text('sugerencias');
            $table->text('fecha_registro');

            $table->primary(['id_servicio_mantenimiento']);
        });

        Schema::table('enc_servicio_mantenimiento', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_enc_servicio_mantenimiento_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_encuesta'], 'fk_enc_servicio_mantenimiento_id_tipo_encuesta')->references(['id_tipo_encuesta'])->on('enc_tipos_encuestas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_servicio_mantenimiento');
    }
};
