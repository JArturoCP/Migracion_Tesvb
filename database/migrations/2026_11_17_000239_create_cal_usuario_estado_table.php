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
        Schema::create('cal_usuario_estado', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_usuario_estado', true);
            $table->integer('id_usuario');
            $table->string('fecha', 100);
            $table->integer('id_validacion_carga');
            $table->string('estado', 100);
            $table->integer('id_estado');

            $table->primary(['id_usuario_estado']);
        });

        Schema::table('cal_usuario_estado', function (Blueprint $table) {
            $table->foreign(['id_validacion_carga'], 'fk_cal_usuario_estado_id_validacion_carga')->references(['id_validacion_carga'])->on('eva_validacion_carga')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_usuario_estado');
    }
};
