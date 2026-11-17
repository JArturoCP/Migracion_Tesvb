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
        $sqlMode = DB::scalar('SELECT @@SESSION.sql_mode');
        DB::statement('SET SESSION sql_mode = ?', [implode(',', array_diff(explode(',', $sqlMode), ['NO_ZERO_DATE', 'NO_ZERO_IN_DATE']))]);

        try {
            Schema::create('gnral_horas_profesores', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_hrs_profesor', true);
                $table->integer('id_horario_profesor')->nullable();
                $table->integer('grupo');
                $table->integer('id_materia_perfil');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_hrs_profesor']);
                $table->index(['id_horario_profesor', 'id_materia_perfil', 'grupo'], 'idx_horas_horario_materia_perfil');
                $table->index(['id_horario_profesor'], 'idx_horario_profesor');
                $table->index(['id_materia_perfil'], 'idx_materia_perfil');
                $table->index(['id_materia_perfil', 'grupo', 'id_horario_profesor', 'id_hrs_profesor'], 'idx_ar_horas_materia_grupo');
            });

            Schema::table('gnral_horas_profesores', function (Blueprint $table) {
                $table->foreign(['id_horario_profesor'], 'fk_gnral_horas_profesores_id_horario_profesor')->references(['id_horario_profesor'])->on('gnral_horarios')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_materia_perfil'], 'fk_gnral_horas_profesores_id_materia_perfil')->references(['id_materia_perfil'])->on('gnral_materias_perfiles')->onDelete('restrict')->onUpdate('cascade');
            });
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_horas_profesores');
    }
};
