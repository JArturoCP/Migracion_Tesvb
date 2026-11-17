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
        Schema::create('egel_preguntas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_pregunta', true);
            $table->integer('id_seccion');
            $table->integer('id_modulo');
            $table->integer('numero_pregunta');
            $table->text('pregunta');
            $table->string('imagen', 255)->nullable();
            $table->enum('tipo', ['opcion_multiple', 'verdadero_falso', 'caso'])->nullable()->default('opcion_multiple');
            $table->boolean('activo')->nullable()->default(1);
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_examen_egel')->nullable();
            $table->decimal('valor', 4, 2)->default('0.99');

            $table->primary(['id_pregunta']);
            $table->index(['id_modulo'], 'fk_preguntas_modulo');
        });

        Schema::table('egel_preguntas', function (Blueprint $table) {
            $table->foreign(['id_examen_egel'], 'fk_egel_preguntas_id_examen_egel')->references(['id_examen_egel'])->on('egel_examenes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_modulo'], 'fk_egel_preguntas_id_modulo')->references(['id_modulo'])->on('egel_modulos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_seccion'], 'fk_egel_preguntas_id_seccion')->references(['id_seccion'])->on('egel_secciones')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('egel_preguntas');
    }
};
