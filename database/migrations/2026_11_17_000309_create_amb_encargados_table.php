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
        Schema::create('amb_encargados', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_encargado', true);
            $table->integer('id_personal');
            $table->integer('id_procedimiento');
            $table->text('fecha_reg');

            $table->primary(['id_encargado']);
        });

        Schema::table('amb_encargados', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_amb_encargados_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_procedimiento'], 'fk_amb_encargados_id_procedimiento')->references(['id_procedimiento'])->on('amb_procedimientos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amb_encargados');
    }
};
