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
            Schema::create('cal_evaluaciones', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_evaluacion', true);
                $table->integer('id_unidad');
                $table->integer('id_carga_academica');
                $table->integer('calificacion');
                $table->integer('esc')->default(0);
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->integer('id_canalizacion')->nullable();
                $table->string('observaciones', 250)->nullable();

                $table->primary(['id_evaluacion']);
                $table->index(['id_carga_academica', 'calificacion'], 'idx_carga_cal');
                $table->index(['id_carga_academica', 'id_unidad', 'calificacion'], 'idx_ar_eval_carga_unidad_cal');
            });

            Schema::table('cal_evaluaciones', function (Blueprint $table) {
                $table->foreign(['id_carga_academica'], 'fk_cal_evaluaciones_id_carga_academica')->references(['id_carga_academica'])->on('eva_carga_academica')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_unidad'], 'fk_cal_evaluaciones_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('cal_evaluaciones');
    }
};
