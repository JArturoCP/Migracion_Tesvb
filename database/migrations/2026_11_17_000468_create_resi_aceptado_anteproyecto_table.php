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
        Schema::create('resi_aceptado_anteproyecto', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_aceptado', true);
            $table->integer('id_anteproyecto');
            $table->integer('id_profesor');

            $table->primary(['id_aceptado']);
        });

        Schema::table('resi_aceptado_anteproyecto', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_aceptado_anteproyecto_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_aceptado_anteproyecto');
    }
};
