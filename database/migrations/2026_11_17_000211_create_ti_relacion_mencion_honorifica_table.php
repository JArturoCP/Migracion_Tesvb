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
        Schema::create('ti_relacion_mencion_honorifica', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_relacion_mencion_honorifica', true);
            $table->string('fecha', 100);
            $table->string('numero_oficio', 100);
            $table->integer('id_estado');
            $table->string('fecha_registro', 100);

            $table->primary(['id_relacion_mencion_honorifica']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_relacion_mencion_honorifica');
    }
};
