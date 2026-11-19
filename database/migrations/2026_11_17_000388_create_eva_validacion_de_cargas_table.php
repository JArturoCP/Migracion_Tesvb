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
            Schema::create('eva_validacion_de_cargas', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id', true);
                $table->integer('id_alumno');
                $table->integer('id_periodo');
                $table->integer('estado_validacion');
                $table->string('descripcion', 500)->nullable();
                $table->integer('no_pregunta');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id']);
                $table->index(['id_alumno', 'id_periodo', 'estado_validacion'], 'idx_alumno_periodo_estado');
            });

            Schema::table('eva_validacion_de_cargas', function (Blueprint $table) {
                $table->foreign(['id_alumno'], 'fk_eva_validacion_de_cargas_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_eva_validacion_de_cargas_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('eva_validacion_de_cargas');
    }
};
