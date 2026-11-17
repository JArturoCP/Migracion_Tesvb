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
            Schema::create('actcomple_docente_actividad', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_docente_actividad', true);
                $table->integer('id_personal')->nullable();
                $table->integer('id_actividad_comple')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->integer('estado')->nullable();
                $table->integer('id_periodo');

                $table->primary(['id_docente_actividad']);
                $table->index(['id_periodo'], 'idx_docente_periodo');
                $table->index(['id_docente_actividad'], 'idx_docente_actividad');
                $table->index(['id_actividad_comple'], 'idx_docente_complementaria');
                $table->index(['id_personal'], 'idx_docente_personal');
            });

            Schema::table('actcomple_docente_actividad', function (Blueprint $table) {
                $table->foreign(['id_actividad_comple'], 'fk_actcomple_docente_actividad_id_actividad_comple')->references(['id_actividad_comple'])->on('actividades_complementarias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_actcomple_docente_actividad_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_personal'], 'fk_actcomple_docente_actividad_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('actcomple_docente_actividad');
    }
};
