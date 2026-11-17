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
        Schema::create('resi_rubro_actitud', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_rubro_actitud', true);
            $table->integer('id_cronograma');
            $table->integer('calificacion');
            $table->integer('id_anteproyecto');
            $table->integer('semana');

            $table->primary(['id_rubro_actitud']);
        });

        Schema::table('resi_rubro_actitud', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_rubro_actitud_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_cronograma'], 'fk_resi_rubro_actitud_id_cronograma')->references(['id_cronograma'])->on('resi_cronograma')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_rubro_actitud');
    }
};
