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
        Schema::create('resi_anteproyecto_profesor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_anteproyecto_profesor', true);
            $table->integer('id_anteproyecto');
            $table->integer('id_profesor');
            $table->integer('id_estado_enviar');

            $table->primary(['id_anteproyecto_profesor']);
        });

        Schema::table('resi_anteproyecto_profesor', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_anteproyecto_profesor_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_anteproyecto_profesor');
    }
};
