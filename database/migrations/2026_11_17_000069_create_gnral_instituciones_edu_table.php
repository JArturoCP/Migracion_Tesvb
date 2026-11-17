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
        Schema::create('gnral_instituciones_edu', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_institucion', true);
            $table->text('cct');
            $table->text('nombre_escuela');
            $table->text('domicilio');
            $table->text('municipio');
            $table->text('localidad');
            $table->text('turno');
            $table->text('servicio');

            $table->primary(['id_institucion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_instituciones_edu');
    }
};
