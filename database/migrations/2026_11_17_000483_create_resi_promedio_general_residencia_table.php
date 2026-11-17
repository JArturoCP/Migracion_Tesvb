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
        Schema::create('resi_promedio_general_residencia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_promedio_general', true);
            $table->integer('calificacion_seguimiento');
            $table->integer('calif_externo_interno');
            $table->integer('promedio_general');
            $table->integer('id_anteproyecto');
            $table->string('fecha_registro', 100);
            $table->integer('id_calificar_departamento');

            $table->primary(['id_promedio_general']);
        });

        Schema::table('resi_promedio_general_residencia', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_promedio_general_residencia_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_promedio_general_residencia');
    }
};
