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
        Schema::create('exp_asigna_alumnos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_alumno', true);
            $table->integer('id_alumno');
            $table->integer('id_asigna_generacion');
            $table->integer('estado')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_alumno']);
        });

        Schema::table('exp_asigna_alumnos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_asigna_alumnos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_asigna_generacion'], 'fk_exp_asigna_alumnos_id_asigna_generacion')->references(['id_asigna_generacion'])->on('exp_asigna_generacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_asigna_alumnos');
    }
};
