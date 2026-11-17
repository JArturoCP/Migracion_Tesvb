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
        Schema::create('enc_periodo_mantenimiento', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_periodo_mantenimiento', true);
            $table->integer('year');
            $table->integer('mes');
            $table->integer('id_estado');
            $table->string('fecha_registro', 100);
            $table->string('fecha_liberacion', 100);

            $table->primary(['id_periodo_mantenimiento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enc_periodo_mantenimiento');
    }
};
