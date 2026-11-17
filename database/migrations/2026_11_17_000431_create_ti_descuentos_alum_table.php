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
        Schema::create('ti_descuentos_alum', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_descuento_alum', true);
            $table->integer('id_tipo_desc');
            $table->text('fecha_registro');
            $table->text('fecha_entrego');
            $table->integer('id_alumno');
            $table->string('telefono', 10);
            $table->integer('id_preparatoria');
            $table->integer('id_liberado');
            $table->text('fecha_liberacion');
            $table->integer('id_liberado_titulado');

            $table->primary(['id_descuento_alum']);
        });

        Schema::table('ti_descuentos_alum', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_descuentos_alum_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_preparatoria'], 'fk_ti_descuentos_alum_id_preparatoria')->references(['id_preparatoria'])->on('ti_preparatatoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_desc'], 'fk_ti_descuentos_alum_id_tipo_desc')->references(['id_tipo_desc'])->on('ti_tipos_desc')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_descuentos_alum');
    }
};
