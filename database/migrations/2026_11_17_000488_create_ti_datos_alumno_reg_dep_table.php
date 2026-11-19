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
        Schema::create('ti_datos_alumno_reg_dep', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_datos_alumno_reg_dep', true);
            $table->integer('id_alumno');
            $table->integer('id_genero');
            $table->integer('id_sexo');
            $table->integer('id_numero_titulo');
            $table->integer('numero_foja_titulo');
            $table->integer('numero_libro_titulo');
            $table->integer('id_tipo_titulo');
            $table->integer('id_decision');
            $table->integer('edad');
            $table->string('fecha_nacimiento', 50);
            $table->integer('id_autorizacion');
            $table->string('fecha_registro', 100);
            $table->integer('id_fundamento_legal');
            $table->integer('id_autorizacion_reconocimiento');
            $table->integer('id_liberado_titulado');

            $table->primary(['id_datos_alumno_reg_dep']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `ti_datos_alumno_reg_dep` MODIFY `id_numero_titulo` int(10) NOT NULL');

        Schema::table('ti_datos_alumno_reg_dep', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_datos_alumno_reg_dep_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_autorizacion_reconocimiento'], 'fk_ti_datos_alumno_reg_dep_id_autorizacion_reconocimiento')->references(['id_autorizacion_reconocimiento'])->on('ti_autorizacion_reconocimiento')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_decision'], 'fk_ti_datos_alumno_reg_dep_id_decision')->references(['id_decision'])->on('ti_decisiones_jurado')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_fundamento_legal'], 'fk_ti_datos_alumno_reg_dep_id_fundamento_legal')->references(['id_fundamento_legal'])->on('ti_fundamento_legal_s_s')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_genero'], 'fk_ti_datos_alumno_reg_dep_id_genero')->references(['id_genero'])->on('ti_genero')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_numero_titulo'], 'fk_ti_datos_alumno_reg_dep_id_numero_titulo')->references(['id_numero_titulo'])->on('ti_numeros_titulos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_sexo'], 'fk_ti_datos_alumno_reg_dep_id_sexo')->references(['id_sexo'])->on('ti_sexo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_titulo'], 'fk_ti_datos_alumno_reg_dep_id_tipo_titulo')->references(['id_tipo_titulo'])->on('ti_tipo_titulo_obtenido')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_datos_alumno_reg_dep');
    }
};
