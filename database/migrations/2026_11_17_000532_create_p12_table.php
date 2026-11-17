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
        Schema::create('p12', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_registro', true);
            $table->integer('id_alumno_materia')->nullable();
            $table->integer('valor')->nullable();

            $table->primary(['id_registro']);
            $table->index(['id_alumno_materia'], 'idx_id_alumno_materia');
        });

        Schema::table('p12', function (Blueprint $table) {
            $table->foreign(['id_alumno_materia'], 'fk_p12_id_alumno_materia')->references(['id_alumno_materia'])->on('eva_alumno_materias')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p12');
    }
};
