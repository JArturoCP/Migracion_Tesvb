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
        Schema::create('ti_numeros_titulos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_numero_titulo', true);
            $table->integer('id_reg_domo');
            $table->integer('numero_titulo');
            $table->string('fecha_reg', 100);
            $table->integer('id_estado_numero_titulo');
            $table->text('comentario');
            $table->integer('id_alumno');
            $table->string('abreviatura_folio_titulo', 100);
            $table->integer('id_tipo_titulacion');
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_numero_titulo']);
        });

        Schema::table('ti_numeros_titulos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_numeros_titulos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_numero_titulo'], 'fk_ti_numeros_titulos_id_estado_numero_titulo')->references(['id_estado_numero_titulo'])->on('ti_estado_numeros_titulos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_reg_domo'], 'fk_ti_numeros_titulos_id_reg_domo')->references(['id_reg_domo'])->on('ti_reg_domo_titulos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_titulacion'], 'fk_ti_numeros_titulos_id_tipo_titulacion')->references(['id_tipo_titulacion'])->on('ti_tipo_titulacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_numeros_titulos');
    }
};
