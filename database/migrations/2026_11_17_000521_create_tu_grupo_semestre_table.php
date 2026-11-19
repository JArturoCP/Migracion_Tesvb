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
        Schema::create('tu_grupo_semestre', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_grupo_semestre', true);
            $table->integer('id_asigna_tutor')->nullable();
            $table->integer('id_grupo_tutorias')->nullable();
            $table->text('fecha_registro')->nullable();

            $table->primary(['id_grupo_semestre']);
        });

        Schema::table('tu_grupo_semestre', function (Blueprint $table) {
            $table->foreign(['id_asigna_tutor'], 'fk_tu_grupo_semestre_id_asigna_tutor')->references(['id_asigna_tutor'])->on('exp_asigna_tutor')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_grupo_semestre');
    }
};
