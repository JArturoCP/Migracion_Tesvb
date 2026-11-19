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
        Schema::create('pres_periodo_anteproyecto', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_peri_anteproyecto', true);
            $table->date('fecha_inicio');
            $table->date('fecha_final');
            $table->integer('year');
            $table->integer('id_activacion');
            $table->string('fecha_registro', 100);
            $table->string('fecha_activacion', 100);
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_peri_anteproyecto']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_periodo_anteproyecto');
    }
};
