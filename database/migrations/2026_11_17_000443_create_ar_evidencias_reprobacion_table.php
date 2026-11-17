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
        Schema::create('ar_evidencias_reprobacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_ar_evidencia', true, true);
            $table->bigInteger('id_ar_estrategia', false, true);
            $table->string('ruta_archivo', 500);
            $table->string('nombre_original', 255)->nullable();
            $table->string('extension', 20)->nullable();
            $table->string('mime', 120)->nullable();
            $table->integer('size_bytes', false, true)->nullable();
            $table->text('observaciones')->nullable();
            $table->integer('id_usuario_subio', false, true)->nullable();
            $table->integer('id_personal_subio')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_evidencia']);
            $table->index(['id_ar_estrategia'], 'idx_ar_evidencia_estrategia');
        });

        Schema::table('ar_evidencias_reprobacion', function (Blueprint $table) {
            $table->foreign(['id_ar_estrategia'], 'fk_ar_evidencias_estrategia')->references(['id_ar_estrategia'])->on('ar_estrategias_reprobacion')->onDelete('cascade');
            $table->foreign(['id_personal_subio'], 'fk_ar_evidencias_reprobacion_id_personal_subio')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_usuario_subio'], 'fk_ar_evidencias_reprobacion_id_usuario_subio')->references(['id'])->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_evidencias_reprobacion');
    }
};
