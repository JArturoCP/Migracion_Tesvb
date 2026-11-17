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
        Schema::create('in_evaluar_calificacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_evaluar_calificacion', true);
            $table->integer('id_unidad');
            $table->integer('id_carga_ingles');
            $table->integer('calificacion');
            $table->integer('esc');
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_evaluar_calificacion']);
            $table->index(['id_carga_ingles', 'id_unidad'], 'idx_evaluar_carga_unidad');
        });

        Schema::table('in_evaluar_calificacion', function (Blueprint $table) {
            $table->foreign(['id_carga_ingles'], 'fk_in_evaluar_calificacion_id_carga_ingles')->references(['id_carga_ingles'])->on('in_carga_academica_ingles')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_in_evaluar_calificacion_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_evaluar_calificacion');
    }
};
