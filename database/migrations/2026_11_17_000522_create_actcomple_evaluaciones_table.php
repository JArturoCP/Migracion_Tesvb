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
            Schema::create('actcomple_evaluaciones', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb3');
                $table->collation('utf8mb3_unicode_ci');

                $table->integer('id_evaluacion', true);
                $table->integer('estado')->nullable();
                $table->string('abreviaciones', 100)->nullable();
                $table->integer('id_evidencia_alumno')->nullable();
                $table->integer('calificacion')->nullable();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->integer('cuenta');

                $table->primary(['id_evaluacion']);
                $table->index(['id_evidencia_alumno', 'estado'], 'idx_eval_evidencia_estado');
                $table->index(['estado', 'id_evidencia_alumno', 'calificacion'], 'idx_eval_estado_evidencia_calificacion');
            });

            Schema::table('actcomple_evaluaciones', function (Blueprint $table) {
                $table->foreign(['id_evidencia_alumno'], 'fk_actcomple_evaluaciones_id_evidencia_alumno')->references(['id_evidencia_alumno'])->on('actcomple_evidencias_alumno')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('actcomple_evaluaciones');
    }
};
