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
        Schema::create('resi_alcances', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_alcances', true);
            $table->integer('id_anteproyecto');
            $table->text('alcances');
            $table->text('limitaciones');
            $table->integer('estado');
            $table->integer('id_periodo_evaluacion_anteproyecto');
            $table->integer('estado_aceptado_alcances');

            $table->primary(['id_alcances']);
        });

        Schema::table('resi_alcances', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_alcances_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_alcances');
    }
};
