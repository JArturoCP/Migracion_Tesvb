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
        Schema::create('ti_acta_titulaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_acta_titulacion', true);
            $table->integer('id_alumno');
            $table->integer('numero_acta_titulacion');
            $table->integer('numero_libro_acta_titulacion');
            $table->integer('foja_acta_titulacion');
            $table->string('hora_conformidad_acta', 100);
            $table->string('hora_levantamiento_acta', 100);
            $table->string('fecha_registro', 100);
            $table->integer('id_autorizar');

            $table->primary(['id_acta_titulacion']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `ti_acta_titulaciones` MODIFY `numero_acta_titulacion` int(10) NOT NULL');
        DB::statement('ALTER TABLE `ti_acta_titulaciones` MODIFY `numero_libro_acta_titulacion` int(10) NOT NULL');
        DB::statement('ALTER TABLE `ti_acta_titulaciones` MODIFY `foja_acta_titulacion` int(10) NOT NULL');

        Schema::table('ti_acta_titulaciones', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_acta_titulaciones_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_acta_titulaciones');
    }
};
