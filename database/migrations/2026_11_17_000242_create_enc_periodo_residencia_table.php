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
        Schema::create('enc_periodo_residencia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_periodo_residencia', true);
            $table->integer('id_periodo');
            $table->string('fecha_registro', 20);
            $table->string('fecha_termino', 20);
            $table->integer('id_estado');

            $table->primary(['id_periodo_residencia']);
        });

        Schema::table('enc_periodo_residencia', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_enc_periodo_residencia_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_periodo_residencia');
    }
};
