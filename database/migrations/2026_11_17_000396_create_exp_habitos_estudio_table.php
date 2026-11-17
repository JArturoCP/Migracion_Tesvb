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
        Schema::create('exp_habitos_estudio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_exp_habitos_estudio', true);
            $table->string('tiempo_empleado_estudiar', 45)->nullable();
            $table->integer('id_opc_intelectual')->nullable();
            $table->string('forma_estudio', 45)->nullable();
            $table->string('tiempo_libre', 100)->nullable();
            $table->string('asignatura_preferida', 100)->nullable();
            $table->string('porque_asignatura', 100)->nullable();
            $table->string('asignatura_dificil', 100)->nullable();
            $table->string('porque_asignatura_dificil', 100)->nullable();
            $table->string('opinion_tu_mismo_estudiante', 255)->nullable();
            $table->integer('id_alumno');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_exp_habitos_estudio']);
            $table->index(['id_opc_intelectual'], 'oin_idx');
        });

        Schema::table('exp_habitos_estudio', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_exp_habitos_estudio_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_opc_intelectual'], 'fk_exp_habitos_estudio_id_opc_intelectual')->references(['id_opc_intelectual'])->on('exp_opc_intelectual')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_habitos_estudio');
    }
};
