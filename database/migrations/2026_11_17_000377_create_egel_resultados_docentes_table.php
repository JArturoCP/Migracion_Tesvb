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
        Schema::create('egel_resultados_docentes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_resultado', true);
            $table->integer('id_docente');
            $table->decimal('calificacion_general', 5, 2)->nullable();
            $table->string('nivel', 50)->nullable();
            $table->integer('id_examen_egel')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_resultado']);
        });

        Schema::table('egel_resultados_docentes', function (Blueprint $table) {
            $table->foreign(['id_examen_egel'], 'fk_egel_resultados_docentes_id_examen_egel')->references(['id_examen_egel'])->on('egel_examenes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_resultados_docentes');
    }
};
