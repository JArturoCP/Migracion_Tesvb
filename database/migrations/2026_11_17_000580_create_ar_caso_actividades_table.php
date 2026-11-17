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
        Schema::create('ar_caso_actividades', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id_ar_actividad', true, true);
            $table->bigInteger('id_ar_caso', false, true);
            $table->bigInteger('id_ar_caso_canalizacion', false, true)->nullable();
            $table->integer('id_ar_cita', false, true)->nullable();
            $table->integer('id_area_atencion', false, true);
            $table->integer('id_actividad_catalogo', false, true)->nullable();
            $table->integer('id_categoria_actividad', false, true)->nullable();
            $table->string('titulo', 150);
            $table->text('descripcion')->nullable();
            $table->dateTime('fecha_asignacion');
            $table->date('fecha_limite')->nullable();
            $table->string('estado', 40)->default('asignada');
            $table->integer('id_personal_asigna')->nullable();
            $table->integer('id_usuario_asigna')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_actividad']);
            $table->index(['id_ar_caso'], 'idx_ar_actividades_caso');
            $table->index(['id_ar_caso_canalizacion'], 'idx_ar_actividades_canalizacion');
            $table->index(['id_area_atencion'], 'idx_ar_actividades_area');
            $table->index(['estado'], 'idx_ar_actividades_estado');
            $table->index(['fecha_limite'], 'idx_ar_actividades_fecha_limite');
            $table->index(['id_ar_cita'], 'idx_ar_actividades_cita');
            $table->index(['id_personal_asigna'], 'idx_ar_actividades_personal');
        });

        Schema::table('ar_caso_actividades', function (Blueprint $table) {
            $table->foreign(['id_actividad_catalogo'], 'fk_ar_caso_actividades_id_actividad_catalogo')->references(['id_actividad_catalogo'])->on('ar_actividad_catalogo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_caso'], 'fk_ar_caso_actividades_id_ar_caso')->references(['id_ar_caso'])->on('ar_casos_estudiantes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_ar_caso_canalizacion'], 'fk_ar_caso_actividades_id_ar_caso_canalizacion')->references(['id_ar_caso_canalizacion'])->on('ar_caso_canalizaciones')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_atencion'], 'fk_ar_caso_actividades_id_area_atencion')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_categoria_actividad'], 'fk_ar_caso_actividades_id_categoria_actividad')->references(['id_categoria_actividad'])->on('ar_actividad_categorias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_asigna'], 'fk_ar_caso_actividades_id_personal_asigna')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_caso_actividades');
    }
};
