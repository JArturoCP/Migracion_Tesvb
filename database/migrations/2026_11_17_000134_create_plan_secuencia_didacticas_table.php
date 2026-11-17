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
        Schema::create('plan_secuencia_didacticas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_secuencia', true, true);
            $table->integer('id_encabezado');
            $table->integer('horas_teoria');
            $table->integer('horas_practica');
            $table->date('fecha_sesion')->nullable();
            $table->integer('numero_sesion');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_unidad')->nullable();

            $table->primary(['id_secuencia']);
            $table->index(['id_encabezado', 'id_unidad', 'numero_sesion'], 'idx_psd_encabezado_unidad_numero');
            $table->index(['id_encabezado', 'id_secuencia', 'fecha_sesion'], 'idx_psd_encabezado_secuencia_fecha');
            $table->index(['id_encabezado', 'id_unidad', 'id_secuencia'], 'idx_psd_encabezado_unidad_secuencia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_secuencia_didacticas');
    }
};
