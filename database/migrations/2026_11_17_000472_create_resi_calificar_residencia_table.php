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
        Schema::create('resi_calificar_residencia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_calificar_residencia', true);
            $table->integer('uno_externo');
            $table->integer('dos_externo');
            $table->integer('tres_externo');
            $table->integer('cuatro_externo');
            $table->integer('cinco_externo');
            $table->integer('seis_externo');
            $table->integer('uno_interno');
            $table->integer('dos_interno');
            $table->integer('tres_interno');
            $table->integer('cuatro_interno');
            $table->integer('cinco_interno');
            $table->integer('seis_interno');
            $table->integer('id_anteproyecto');
            $table->text('observacion');

            $table->primary(['id_calificar_residencia']);
        });

        Schema::table('resi_calificar_residencia', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_calificar_residencia_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_calificar_residencia');
    }
};
