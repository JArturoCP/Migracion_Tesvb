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
            Schema::create('actcomple_registro_alumnos', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_registro_alumno', true);
                $table->string('cuenta', 11)->nullable();
                $table->integer('id_periodo')->nullable();
                $table->integer('id_docente_actividad')->nullable();
                $table->integer('liberacion')->nullable();
                $table->integer('id_semestre')->nullable();
                $table->date('fecha_registro')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_registro_alumno']);
                $table->index(['id_docente_actividad'], 'idx_registro_docente');
                $table->index(['cuenta'], 'idx_registro_cuenta');
                $table->index(['id_registro_alumno'], 'idx_registro_alumno');
            });

            Schema::table('actcomple_registro_alumnos', function (Blueprint $table) {
                $table->foreign(['id_docente_actividad'], 'fk_actcomple_registro_alumnos_id_docente_actividad')->references(['id_docente_actividad'])->on('actcomple_docente_actividad')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_actcomple_registro_alumnos_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_semestre'], 'fk_actcomple_registro_alumnos_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('actcomple_registro_alumnos');
    }
};
