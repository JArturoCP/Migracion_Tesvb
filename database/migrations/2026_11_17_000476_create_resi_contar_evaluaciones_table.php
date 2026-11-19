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
        Schema::create('resi_contar_evaluaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_contar_evaluaciones', true);
            $table->integer('id_anteproyecto');
            $table->integer('numero_evaluacion');

            $table->primary(['id_contar_evaluaciones']);
        });

        Schema::table('resi_contar_evaluaciones', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_contar_evaluaciones_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_contar_evaluaciones');
    }
};
