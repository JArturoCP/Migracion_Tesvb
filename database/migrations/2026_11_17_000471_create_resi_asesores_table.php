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
        Schema::create('resi_asesores', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asesores', true);
            $table->integer('id_profesor');
            $table->integer('id_carrera');
            $table->integer('id_anteproyecto');
            $table->integer('id_periodo');

            $table->primary(['id_asesores']);
        });

        Schema::table('resi_asesores', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_asesores_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_resi_asesores_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_resi_asesores_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_asesores');
    }
};
