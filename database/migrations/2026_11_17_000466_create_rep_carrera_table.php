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
        Schema::create('rep_carrera', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_repcarrera', true);
            $table->integer('id_asigna_generacion');
            $table->text('observaciones');
            $table->string('fecha_registro', 100);

            $table->primary(['id_repcarrera']);
        });

        Schema::table('rep_carrera', function (Blueprint $table) {
            $table->foreign(['id_asigna_generacion'], 'fk_rep_carrera_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rep_carrera');
    }
};
