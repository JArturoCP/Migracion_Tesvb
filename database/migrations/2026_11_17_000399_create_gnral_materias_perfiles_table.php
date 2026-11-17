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
            Schema::create('gnral_materias_perfiles', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_materia_perfil', true);
                $table->integer('id_personal');
                $table->integer('id_materia');
                $table->integer('mostrar');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_materia_perfil']);
                $table->index(['id_materia', 'id_materia_perfil'], 'idx_materias_perfiles_materia');
                $table->index(['id_materia_perfil'], 'idx_materias_perfiles_perfil');
                $table->index(['id_materia'], 'idx_materia');
                $table->index(['id_personal'], 'idx_personal');
                $table->index(['id_materia', 'id_personal', 'mostrar', 'id_materia_perfil'], 'idx_ar_matperf_materia_personal');
            });

            Schema::table('gnral_materias_perfiles', function (Blueprint $table) {
                $table->foreign(['id_materia'], 'fk_gnral_materias_perfiles_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_personal'], 'fk_gnral_materias_perfiles_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('gnral_materias_perfiles');
    }
};
