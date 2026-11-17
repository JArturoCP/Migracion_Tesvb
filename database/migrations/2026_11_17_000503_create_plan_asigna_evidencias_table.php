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
        Schema::create('plan_asigna_evidencias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_evidencia', true);
            $table->string('evidencia', 80)->nullable();
            $table->integer('id_alumno');
            $table->integer('id_asigna_planeacion_tutor');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_evidencia']);
        });

        Schema::table('plan_asigna_evidencias', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_plan_asigna_evidencias_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_asigna_planeacion_tutor'], 'fk_plan_asigna_evidencias_id_asigna_planeacion_tutor')->references(['id_asigna_planeacion_tutor'])->on('plan_asigna_planeacion_tutor')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_asigna_evidencias');
    }
};
