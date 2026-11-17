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
        Schema::create('in_bitacora_calificaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_bitacora_calificaciones', true);
            $table->integer('id_unidad');
            $table->integer('id_carga_ingles');
            $table->timestamp('fecha_modificacion')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_periodo');
            $table->integer('id_profesor');
            $table->integer('calificacion_registrada');
            $table->integer('calificacion_anterior');

            $table->primary(['id_bitacora_calificaciones']);
        });

        Schema::table('in_bitacora_calificaciones', function (Blueprint $table) {
            $table->foreign(['id_carga_ingles'], 'fk_in_bitacora_calificaciones_id_carga_ingles')->references(['id_carga_ingles'])->on('in_carga_academica_ingles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_in_bitacora_calificaciones_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_in_bitacora_calificaciones_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_bitacora_calificaciones');
    }
};
