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
            Schema::create('actcomple_registros_coordinadores', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb3');
                $table->collation('utf8mb3_unicode_ci');

                $table->integer('id_reg_coordinador', true);
                $table->integer('vigencia')->nullable();
                $table->integer('no_evidencias')->nullable();
                $table->string('rubrica', 500)->nullable();
                $table->integer('id_periodo_carrera')->nullable();
                $table->date('fecha_registro')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->integer('id_docente_actividad')->nullable();
                $table->integer('estado_evidencias')->nullable();

                $table->primary(['id_reg_coordinador']);
                $table->index(['id_docente_actividad'], 'idx_coordinador_docente');
                $table->index(['id_periodo_carrera'], 'idx_coordinador_periodo');
            });

            Schema::table('actcomple_registros_coordinadores', function (Blueprint $table) {
                $table->foreign(['id_docente_actividad'], 'fk_actcomple_registros_coordinadores_id_docente_actividad')->references(['id_docente_actividad'])->on('actcomple_docente_actividad')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo_carrera'], 'fk_actcomple_registros_coordinadores_id_periodo_carrera')->references(['id_periodo_carrera'])->on('gnral_periodo_carreras')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('actcomple_registros_coordinadores');
    }
};
