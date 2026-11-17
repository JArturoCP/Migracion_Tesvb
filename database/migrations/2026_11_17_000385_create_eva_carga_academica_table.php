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
            Schema::create('eva_carga_academica', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_carga_academica', true);
                $table->integer('id_alumno')->nullable();
                $table->integer('id_materia')->nullable();
                $table->integer('id_status_materia')->nullable();
                $table->integer('id_tipo_curso')->nullable();
                $table->integer('id_periodo')->nullable();
                $table->integer('grupo')->nullable();
                $table->string('tipo_alumno', 250)->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_carga_academica']);
                $table->index(['id_alumno', 'id_status_materia', 'id_materia'], 'idx_alumno_status_materia');
                $table->index(['id_periodo', 'id_materia', 'grupo', 'id_alumno', 'id_carga_academica'], 'idx_ar_carga_periodo_materia_grupo_alumno');
                $table->index(['id_alumno', 'id_periodo', 'id_materia', 'id_carga_academica'], 'idx_ar_carga_alumno_periodo_materia');
            });

            Schema::table('eva_carga_academica', function (Blueprint $table) {
                $table->foreign(['id_alumno'], 'fk_eva_carga_academica_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_materia'], 'fk_eva_carga_academica_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_eva_carga_academica_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('eva_carga_academica');
    }
};
