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
        Schema::create('tu_eva_periodo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eva_periodo', true);
            $table->integer('id_periodo');
            $table->boolean('estado');
            $table->dateTime('fecha_registro');
            $table->dateTime('fecha_final_eva');

            $table->primary(['id_eva_periodo']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `tu_eva_periodo` MODIFY `id_eva_periodo` int(10) NOT NULL AUTO_INCREMENT');

        Schema::table('tu_eva_periodo', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_tu_eva_periodo_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_periodo');
    }
};
