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
            Schema::create('cal_bitacora_evaluaciones', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_bitacora_eval', true);
                $table->integer('id_evaluacion');
                $table->integer('id_unidad');
                $table->integer('id_carga_academica');
                $table->integer('id_materia');
                $table->string('docente', 250);
                $table->integer('cal_antigua');
                $table->integer('cal_nueva');
                $table->integer('id_periodo');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_bitacora_eval']);
            });

            Schema::table('cal_bitacora_evaluaciones', function (Blueprint $table) {
                $table->foreign(['id_carga_academica'], 'fk_cal_bitacora_evaluaciones_id_carga_academica')->references(['id_carga_academica'])->on('eva_carga_academica')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_evaluacion'], 'fk_cal_bitacora_evaluaciones_id_evaluacion')->references(['id_evaluacion'])->on('cal_evaluaciones')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_materia'], 'fk_cal_bitacora_evaluaciones_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_cal_bitacora_evaluaciones_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_unidad'], 'fk_cal_bitacora_evaluaciones_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('cal_bitacora_evaluaciones');
    }
};
