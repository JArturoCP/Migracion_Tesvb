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
        Schema::create('oc_oficio_vehiculo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_oficio_vehiculo', true);
            $table->integer('id_vehiculo');
            $table->integer('id_oficio_personal');
            $table->date('fecha_salida');
            $table->date('fecha_regreso');
            $table->string('licencia', 100);
            $table->integer('notificacion');

            $table->primary(['id_oficio_vehiculo']);
        });

        Schema::table('oc_oficio_vehiculo', function (Blueprint $table) {
            $table->foreign(['id_oficio_personal'], 'fk_oc_oficio_vehiculo_id_oficio_personal')->references(['id_oficio_personal'])->on('oc_oficio_personal')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_vehiculo'], 'fk_oc_oficio_vehiculo_id_vehiculo')->references(['id_vehiculo'])->on('oc_vehiculo')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oc_oficio_vehiculo');
    }
};
