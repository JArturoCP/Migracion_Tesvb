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
        Schema::create('egel_periodo_resultados_examen', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_periodo_resultado_examen', true);
            $table->string('periodo', 500)->nullable();
            $table->timestamp('fecha_inicio')->useCurrent();
            $table->timestamp('fecha_fin')->nullable();
            $table->integer('estado')->nullable();
            $table->integer('id_periodo_examen')->nullable();

            $table->primary(['id_periodo_resultado_examen']);
        });

        Schema::table('egel_periodo_resultados_examen', function (Blueprint $table) {
            $table->foreign(['id_periodo_examen'], 'fk_egel_periodo_resultados_examen_id_periodo_examen')->references(['id_periodo_examen'])->on('egel_periodo_examen')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_periodo_resultados_examen');
    }
};
