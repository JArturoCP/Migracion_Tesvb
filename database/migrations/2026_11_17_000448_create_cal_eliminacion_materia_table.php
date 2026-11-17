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
        Schema::create('cal_eliminacion_materia', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eliminacion_materia', true);
            $table->integer('id_carga_academica');
            $table->string('fecha', 100);

            $table->primary(['id_eliminacion_materia']);
        });

        Schema::table('cal_eliminacion_materia', function (Blueprint $table) {
            $table->foreign(['id_carga_academica'], 'fk_cal_eliminacion_materia_id_carga_academica')->references(['id_carga_academica'])->on('eva_carga_academica')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_eliminacion_materia');
    }
};
