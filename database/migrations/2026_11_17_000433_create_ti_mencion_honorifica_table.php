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
        Schema::create('ti_mencion_honorifica', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_mencion_honorifica', true);
            $table->integer('no_registro');
            $table->integer('libro_registro');
            $table->string('fecha_registro_dato', 100);
            $table->integer('id_alumno');

            $table->primary(['id_mencion_honorifica']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `ti_mencion_honorifica` MODIFY `no_registro` int(10) NOT NULL');
        DB::statement('ALTER TABLE `ti_mencion_honorifica` MODIFY `libro_registro` int(10) NOT NULL');

        Schema::table('ti_mencion_honorifica', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_mencion_honorifica_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_mencion_honorifica');
    }
};
