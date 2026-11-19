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
            Schema::create('gnral_materias', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_materia', true);
                $table->string('nombre', 80)->nullable();
                $table->string('clave', 10)->nullable();
                $table->integer('hrs_practicas')->nullable();
                $table->integer('hrs_teoria')->nullable();
                $table->integer('id_reticula');
                $table->integer('id_semestre');
                $table->integer('creditos');
                $table->integer('unidades');
                $table->integer('especial');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_materia']);
                $table->index(['id_reticula', 'id_semestre', 'id_materia'], 'idx_materias_reticula_semestre');
                $table->index(['clave', 'id_materia'], 'idx_ar_materias_clave');
                $table->index(['nombre', 'id_materia'], 'idx_ar_materias_nombre');
            });

            // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
            DB::statement('ALTER TABLE `gnral_materias` MODIFY `especial` int(1) NOT NULL');

            Schema::table('gnral_materias', function (Blueprint $table) {
                $table->foreign(['id_reticula'], 'fk_gnral_materias_id_reticula')->references(['id_reticula'])->on('gnral_reticulas')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_semestre'], 'fk_gnral_materias_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('gnral_materias');
    }
};
