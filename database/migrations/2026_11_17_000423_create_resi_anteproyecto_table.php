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
        Schema::create('resi_anteproyecto', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_anteproyecto', true);
            $table->integer('id_alumno');
            $table->integer('id_periodo');
            $table->integer('estado_enviado');
            $table->integer('id_proyecto');
            $table->date('fecha');
            $table->integer('estado_revision');
            $table->integer('estado_notificaciones');
            $table->integer('estado_aceptado_portada');
            $table->integer('id_estado_aceptado_anteproyecto');
            $table->integer('autorizacion_departamento');
            $table->integer('estado_permiso')->nullable();

            $table->primary(['id_anteproyecto']);
        });

        Schema::table('resi_anteproyecto', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_resi_anteproyecto_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_resi_anteproyecto_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_proyecto'], 'fk_resi_anteproyecto_id_proyecto')->references(['id_proyecto'])->on('resi_proyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_anteproyecto');
    }
};
