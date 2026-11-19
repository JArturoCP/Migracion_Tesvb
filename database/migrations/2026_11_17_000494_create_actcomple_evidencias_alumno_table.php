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
            Schema::create('actcomple_evidencias_alumno', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_evidencia_alumno', true);
                $table->string('archivo', 500)->nullable();
                $table->integer('id_registro_alumno')->nullable();
                $table->integer('numero_evidencias');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_evidencia_alumno']);
                $table->index(['id_registro_alumno'], 'idx_evidencia_registro');
                $table->index(['id_evidencia_alumno'], 'idx_evidencia_alumno');
            });

            // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
            DB::statement('ALTER TABLE `actcomple_evidencias_alumno` MODIFY `numero_evidencias` int(10) NOT NULL');

            Schema::table('actcomple_evidencias_alumno', function (Blueprint $table) {
                $table->foreign(['id_registro_alumno'], 'fk_actcomple_evidencias_alumno_id_registro_alumno')->references(['id_registro_alumno'])->on('actcomple_registro_alumnos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('actcomple_evidencias_alumno');
    }
};
