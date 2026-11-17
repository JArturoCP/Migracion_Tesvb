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
            Schema::create('resi_periodo_eval_anteproyecto', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_periodo_eval_anteproyecto', true);
                $table->integer('id_periodo');
                $table->date('fecha_inicio');
                $table->date('fecha_final');
                $table->integer('estado_periodo');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_periodo_eval_anteproyecto']);
            });

            Schema::table('resi_periodo_eval_anteproyecto', function (Blueprint $table) {
                $table->foreign(['id_periodo'], 'fk_resi_periodo_eval_anteproyecto_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('resi_periodo_eval_anteproyecto');
    }
};
