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
            Schema::create('cal_bitacora_periodos', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_bitacora_periodo', true);
                $table->integer('id_periodo_cal');
                $table->integer('id_unidad');
                $table->integer('id_grupo');
                $table->integer('id_materia');
                $table->string('docente', 120);
                $table->date('fecha_antigua');
                $table->date('fecha_nueva');
                $table->integer('id_periodo');
                $table->text('observaciones')->charset('latin1')->collation('latin1_spanish_ci')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_bitacora_periodo']);
            });

            Schema::table('cal_bitacora_periodos', function (Blueprint $table) {
                $table->foreign(['id_grupo'], 'fk_cal_bitacora_periodos_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_materia'], 'fk_cal_bitacora_periodos_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_cal_bitacora_periodos_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo_cal'], 'fk_cal_bitacora_periodos_id_periodo_cal')->references(['id_periodo_cal'])->on('cal_periodos_califica')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_unidad'], 'fk_cal_bitacora_periodos_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('cal_bitacora_periodos');
    }
};
