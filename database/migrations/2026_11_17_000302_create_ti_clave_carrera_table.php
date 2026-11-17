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
        Schema::create('ti_clave_carrera', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_clave_carrera', true);
            $table->integer('id_carrera');
            $table->string('clave', 100);
            $table->text('carrera_cedula');

            $table->primary(['id_clave_carrera']);
        });

        Schema::table('ti_clave_carrera', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_ti_clave_carrera_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_clave_carrera');
    }
};
