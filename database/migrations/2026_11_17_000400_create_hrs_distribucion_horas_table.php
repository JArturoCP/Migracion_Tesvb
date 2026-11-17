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
            Schema::create('hrs_distribucion_horas', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_distribucion_hora', true);
                $table->integer('no_alum')->nullable();
                $table->integer('alum_otras_carreras')->nullable();
                $table->integer('hrs_docente');
                $table->integer('hrs_dir_atm_hono');
                $table->integer('directivo');
                $table->integer('atm');
                $table->integer('honorarios');
                $table->integer('id_periodo_carrera');
                $table->integer('id_materia');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_distribucion_hora']);
            });

            Schema::table('hrs_distribucion_horas', function (Blueprint $table) {
                $table->foreign(['id_materia'], 'fk_hrs_distribucion_horas_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo_carrera'], 'fk_hrs_distribucion_horas_id_periodo_carrera')->references(['id_periodo_carrera'])->on('gnral_periodo_carreras')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('hrs_distribucion_horas');
    }
};
