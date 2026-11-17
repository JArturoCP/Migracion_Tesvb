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
        Schema::create('ar_cortes_reprobacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_ar_corte', true, true);
            $table->integer('id_periodo');
            $table->integer('id_carrera');
            $table->integer('id_materia');
            $table->integer('id_grupo');
            $table->integer('id_unidad')->default(0);
            $table->integer('id_personal_docente')->default(0);
            $table->dateTime('fecha_corte')->useCurrent();
            $table->smallInteger('anio_corte')->default(0);
            $table->tinyInteger('mes_corte')->default(0);
            $table->integer('total_inscritos', false, true)->default(0);
            $table->integer('total_reprobados', false, true)->default(0);
            $table->decimal('porcentaje_reprobacion', 5, 2)->default('0.00');
            $table->integer('id_usuario_genero', false, true)->nullable();
            $table->integer('id_personal_genero')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_ar_corte']);
            $table->unique(['id_periodo', 'id_carrera', 'id_materia', 'id_grupo', 'id_unidad', 'id_personal_docente', 'anio_corte', 'mes_corte'], 'uq_ar_corte_contexto_mes');
            $table->index(['id_carrera', 'id_periodo', 'id_grupo', 'id_unidad'], 'idx_ar_corte_carrera_periodo');
            $table->index(['id_materia', 'id_carrera', 'id_periodo', 'id_grupo'], 'idx_ar_corte_materia_hist');
            $table->index(['id_personal_docente', 'id_periodo'], 'idx_ar_corte_docente');
        });

        Schema::table('ar_cortes_reprobacion', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_ar_cortes_reprobacion_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_grupo'], 'fk_ar_cortes_reprobacion_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_materia'], 'fk_ar_cortes_reprobacion_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_ar_cortes_reprobacion_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_genero'], 'fk_ar_cortes_reprobacion_id_personal_genero')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_ar_cortes_reprobacion_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_usuario_genero'], 'fk_ar_cortes_reprobacion_id_usuario_genero')->references(['id'])->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_cortes_reprobacion');
    }
};
