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
        Schema::create('egel_respuestas_docente', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_respuesta_docente', true);
            $table->integer('id_docente');
            $table->integer('id_seccion');
            $table->integer('id_pregunta');
            $table->integer('id_respuesta');
            $table->boolean('es_correcta')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->integer('id_examen_egel');
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();

            $table->primary(['id_respuesta_docente']);
        });

        Schema::table('egel_respuestas_docente', function (Blueprint $table) {
            $table->foreign(['id_examen_egel'], 'fk_egel_respuestas_docente_id_examen_egel')->references(['id_examen_egel'])->on('egel_examenes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_pregunta'], 'fk_egel_respuestas_docente_id_pregunta')->references(['id_pregunta'])->on('egel_preguntas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_respuesta'], 'fk_egel_respuestas_docente_id_respuesta')->references(['id_respuesta'])->on('egel_respuestas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_seccion'], 'fk_egel_respuestas_docente_id_seccion')->references(['id_seccion'])->on('egel_secciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_respuestas_docente');
    }
};
