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
        Schema::create('rep_institucional', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_repinstitucional', true);
            $table->integer('id_carrera');
            $table->integer('id_periodo');
            $table->text('observaciones');
            $table->string('fecha_registro', 100);

            $table->primary(['id_repinstitucional']);
        });

        Schema::table('rep_institucional', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_rep_institucional_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_rep_institucional_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rep_institucional');
    }
};
