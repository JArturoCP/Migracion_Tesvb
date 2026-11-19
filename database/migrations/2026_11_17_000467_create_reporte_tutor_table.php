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
        Schema::create('reporte_tutor', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reporte_tutor', true);
            $table->integer('id_asigna_generacion');
            $table->string('alumno', 50);
            $table->string('appaterno', 30);
            $table->string('apmaterno', 30);
            $table->string('n_cuenta', 100);
            $table->string('tutoria_grupal', 5);
            $table->string('tutoria_individual', 5);
            $table->text('beca')->nullable();
            $table->string('repeticion', 5)->nullable();
            $table->string('especial', 5)->nullable();
            $table->string('academico', 5);
            $table->string('medico', 5);
            $table->string('psicologico', 5);
            $table->string('baja', 5);
            $table->text('observaciones')->nullable();

            $table->primary(['id_reporte_tutor']);
        });

        Schema::table('reporte_tutor', function (Blueprint $table) {
            $table->foreign(['id_asigna_generacion'], 'fk_reporte_tutor_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte_tutor');
    }
};
