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
        Schema::create('oc_oficio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_oficio', true);
            $table->date('fecha');
            $table->text('desc_comision');
            $table->date('fecha_salida');
            $table->date('fecha_regreso');
            $table->string('hora_s', 20);
            $table->string('hora_r', 20);
            $table->integer('id_lugar_salida');
            $table->integer('id_lugar_entrada');
            $table->string('fecha_hora', 20);
            $table->integer('id_usuario');
            $table->string('updated_at', 100);
            $table->integer('id_notificacion_solicitud');

            $table->primary(['id_oficio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oc_oficio');
    }
};
