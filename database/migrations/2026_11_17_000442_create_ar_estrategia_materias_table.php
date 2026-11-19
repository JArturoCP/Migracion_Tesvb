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
        Schema::create('ar_estrategia_materias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_ar_estrategia_materia', true, true);
            $table->bigInteger('id_ar_estrategia', false, true);
            $table->integer('id_materia');
            $table->integer('id_carga_academica')->nullable();
            $table->integer('id_unidad')->nullable();
            $table->integer('calificacion')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_estrategia_materia']);
            $table->unique(['id_ar_estrategia', 'id_materia', 'id_unidad'], 'uq_ar_estrategia_materia');
            $table->index(['id_materia', 'id_unidad'], 'idx_ar_estrategia_materia_materia');
        });

        Schema::table('ar_estrategia_materias', function (Blueprint $table) {
            $table->foreign(['id_ar_estrategia'], 'fk_ar_estrategia_materias')->references(['id_ar_estrategia'])->on('ar_estrategias_reprobacion')->onDelete('cascade');
            $table->foreign(['id_carga_academica'], 'fk_ar_estrategia_materias_id_carga_academica')->references(['id_carga_academica'])->on('eva_carga_academica')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_materia'], 'fk_ar_estrategia_materias_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_ar_estrategia_materias_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_estrategia_materias');
    }
};
