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
        Schema::create('ti_titulos_libros', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_titulo_libro', true);
            $table->integer('id_reg_dato_alumno');
            $table->text('titulo');
            $table->text('autor');
            $table->text('editorial');
            $table->text('fecha_registro');

            $table->primary(['id_titulo_libro']);
        });

        Schema::table('ti_titulos_libros', function (Blueprint $table) {
            $table->foreign(['id_reg_dato_alumno'], 'fk_ti_titulos_libros_id_reg_dato_alumno')->references(['id_reg_dato_alum'])->on('ti_reg_datos_alum')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_titulos_libros');
    }
};
