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
        Schema::create('egel_secciones_estado_docentes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_seccion_estado_docente', true);
            $table->integer('id_docente')->nullable();
            $table->integer('id_seccion')->nullable();
            $table->boolean('completada')->nullable()->default(0);
            $table->timestamp('fecha_fin')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_examen_egel')->nullable();
            $table->integer('id_periodo_examen')->nullable();

            $table->primary(['id_seccion_estado_docente']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `egel_secciones_estado_docentes` MODIFY `id_seccion_estado_docente` int(20) NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE `egel_secciones_estado_docentes` MODIFY `id_docente` int(20) DEFAULT NULL');

        Schema::table('egel_secciones_estado_docentes', function (Blueprint $table) {
            $table->foreign(['id_examen_egel'], 'fk_egel_secciones_estado_docentes_id_examen_egel')->references(['id_examen_egel'])->on('egel_examenes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_examen'], 'fk_egel_secciones_estado_docentes_id_periodo_examen')->references(['id_periodo_examen'])->on('egel_periodo_examen')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_seccion'], 'fk_egel_secciones_estado_docentes_id_seccion')->references(['id_seccion'])->on('egel_secciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_secciones_estado_docentes');
    }
};
