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
        Schema::create('serv_datos_alumnos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_datos_alumnos', true);
            $table->string('correo_electronico', 200);
            $table->integer('id_tipo_empresa');
            $table->integer('id_periodo');
            $table->integer('id_alumno');
            $table->string('fecha_registro', 100);
            $table->integer('id_estado_enviado');
            $table->integer('id_estado_presentacion');

            $table->primary(['id_datos_alumnos']);
        });

        Schema::table('serv_datos_alumnos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_serv_datos_alumnos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_serv_datos_alumnos_id_periodo')->references(['id_periodo'])->on('serv_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_empresa'], 'fk_serv_datos_alumnos_id_tipo_empresa')->references(['id_tipo_empresa'])->on('serv_tipo_empresa')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serv_datos_alumnos');
    }
};
