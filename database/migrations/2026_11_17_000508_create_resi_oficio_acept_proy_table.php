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
        Schema::create('resi_oficio_acept_proy', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_oficio_aceptacion', true);
            $table->text('numero_oficio');
            $table->integer('id_asesores');
            $table->string('fecha_registro', 100);
            $table->string('fecha_m', 100);

            $table->primary(['id_oficio_aceptacion']);
        });

        Schema::table('resi_oficio_acept_proy', function (Blueprint $table) {
            $table->foreign(['id_asesores'], 'fk_resi_oficio_acept_proy_id_asesores')->references(['id_asesores'])->on('resi_asesores')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_oficio_acept_proy');
    }
};
