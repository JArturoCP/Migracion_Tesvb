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
        Schema::create('egel_examenes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_examen_egel', true);
            $table->integer('id_carrera');
            $table->string('nombre', 255);
            $table->boolean('estado')->nullable()->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_periodo_examen')->nullable();
            $table->integer('id_periodo_resultado_examen')->nullable();

            $table->primary(['id_examen_egel']);
            $table->index(['id_carrera'], 'fk_examen_carrera');
        });

        Schema::table('egel_examenes', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_egel_examenes_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_examen'], 'fk_egel_examenes_id_periodo_examen')->references(['id_periodo_examen'])->on('egel_periodo_examen')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_resultado_examen'], 'fk_egel_examenes_id_periodo_resultado_examen')->references(['id_periodo_resultado_examen'])->on('egel_periodo_resultados_examen')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_examenes');
    }
};
