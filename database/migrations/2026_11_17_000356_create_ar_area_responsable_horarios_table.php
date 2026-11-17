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
        Schema::create('ar_area_responsable_horarios', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_area_responsable_horario', true, true);
            $table->integer('id_area_responsable_periodo', false, true);
            $table->integer('id_area_atencion', false, true);
            $table->integer('id_periodo');
            $table->integer('id_personal');
            $table->tinyInteger('dia_semana', false, true)->comment('1=Lunes, 2=Martes, 3=Miércoles, 4=Jueves, 5=Viernes, 6=Sábado, 7=Domingo');
            $table->time('hora_inicio');
            $table->time('hora_fin');
            $table->string('lugar', 150)->nullable();
            $table->integer('cupo')->default(1);
            $table->boolean('activo')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_area_responsable_horario']);
            $table->index(['id_area_responsable_periodo'], 'idx_ar_area_horario_responsable');
            $table->index(['id_area_atencion', 'id_periodo'], 'idx_ar_area_horario_area_periodo');
            $table->index(['id_personal'], 'idx_ar_area_horario_personal');
            $table->index(['dia_semana'], 'idx_ar_area_horario_dia');
            $table->index(['activo'], 'idx_ar_area_horario_activo');
        });

        Schema::table('ar_area_responsable_horarios', function (Blueprint $table) {
            $table->foreign(['id_area_atencion'], 'fk_ar_area_responsable_horarios_id_area_atencion')->references(['id_area_atencion'])->on('ar_areas_atencion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_area_responsable_periodo'], 'fk_ar_area_responsable_horarios_id_area_responsable_periodo')->references(['id_area_responsable_periodo'])->on('ar_area_responsables_periodo')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_ar_area_responsable_horarios_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_ar_area_responsable_horarios_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_area_responsable_horarios');
    }
};
