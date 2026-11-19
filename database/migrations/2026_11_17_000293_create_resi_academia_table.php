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
        Schema::create('resi_academia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_academia', true);
            $table->integer('id_profesor');
            $table->integer('id_carrera');
            $table->integer('id_cargo_academia');

            $table->primary(['id_academia']);
        });

        Schema::table('resi_academia', function (Blueprint $table) {
            $table->foreign(['id_cargo_academia'], 'fk_resi_academia_id_cargo_academia')->references(['id_cargo_academia'])->on('resi_cargo_academia')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_carrera'], 'fk_resi_academia_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_academia');
    }
};
