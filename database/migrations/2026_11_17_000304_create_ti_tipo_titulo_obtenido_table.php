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
        Schema::create('ti_tipo_titulo_obtenido', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_tipo_titulo', true);
            $table->text('tipo_titulo');
            $table->integer('id_carrera');

            $table->primary(['id_tipo_titulo']);
        });

        Schema::table('ti_tipo_titulo_obtenido', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_ti_tipo_titulo_obtenido_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_tipo_titulo_obtenido');
    }
};
