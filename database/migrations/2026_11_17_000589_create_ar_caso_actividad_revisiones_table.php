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
        Schema::create('ar_caso_actividad_revisiones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_revision', true, true);
            $table->bigInteger('id_ar_entrega', false, true);
            $table->dateTime('fecha_revision');
            $table->boolean('validada')->default(0);
            $table->tinyInteger('calificacion_estrellas', false, true)->nullable();
            $table->string('estado_revision', 30)->nullable();
            $table->text('comentarios')->nullable();
            $table->text('recomendaciones')->nullable();
            $table->integer('id_personal_revisa')->nullable();
            $table->integer('id_usuario_revisa')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_revision']);
            $table->index(['id_ar_entrega'], 'idx_ar_revision_entrega');
            $table->index(['id_personal_revisa'], 'idx_ar_revision_personal');
            $table->index(['fecha_revision'], 'idx_ar_revision_fecha');
            $table->index(['validada'], 'idx_ar_revision_validada');
        });

        Schema::table('ar_caso_actividad_revisiones', function (Blueprint $table) {
            $table->foreign(['id_ar_entrega'], 'fk_ar_caso_actividad_revisiones_id_ar_entrega')->references(['id_ar_entrega'])->on('ar_caso_actividad_entregas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_revisa'], 'fk_ar_caso_actividad_revisiones_id_personal_revisa')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_caso_actividad_revisiones');
    }
};
