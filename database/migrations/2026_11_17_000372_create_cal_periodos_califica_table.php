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
            Schema::create('cal_periodos_califica', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_periodo_cal', true);
                $table->date('fecha');
                $table->integer('id_unidad');
                $table->integer('id_periodos');
                $table->integer('id_materia');
                $table->integer('id_grupo');
                $table->integer('evaluada');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->string('acciones_preventivas', 250)->nullable();

                $table->primary(['id_periodo_cal']);
                $table->index(['id_periodos', 'id_materia', 'id_grupo', 'id_unidad', 'evaluada'], 'idx_ar_periodos_califica_contexto');
            });

            Schema::table('cal_periodos_califica', function (Blueprint $table) {
                $table->foreign(['id_grupo'], 'fk_cal_periodos_califica_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_materia'], 'fk_cal_periodos_califica_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_unidad'], 'fk_cal_periodos_califica_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('cal_periodos_califica');
    }
};
