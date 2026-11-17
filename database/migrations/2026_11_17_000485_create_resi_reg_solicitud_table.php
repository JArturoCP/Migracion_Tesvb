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
        Schema::create('resi_reg_solicitud', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reg_solicitud', true);
            $table->integer('id_opcion_proyecto');
            $table->string('rfc_empresa', 20);
            $table->text('colonia_empresa');
            $table->string('codigo_postal_empresa', 100);
            $table->string('ciudad_municipio_empresa', 100);
            $table->string('telefono_empresa', 100);
            $table->text('mision_empresa');
            $table->text('puesto_titular_empresa');
            $table->string('nombre_acuerdo_empresa', 100);
            $table->string('puesto_acuerdo_empresa', 100);
            $table->text('domiclio_estudiante');
            $table->string('no_seguro_estudiante', 100);
            $table->string('telefono_estudiante', 100);
            $table->integer('id_anteproyecto');
            $table->string('fecha_registro', 100);

            $table->primary(['id_reg_solicitud']);
        });

        Schema::table('resi_reg_solicitud', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_reg_solicitud_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_reg_solicitud');
    }
};
