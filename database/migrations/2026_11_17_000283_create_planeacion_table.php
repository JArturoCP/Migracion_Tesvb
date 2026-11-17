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
        Schema::create('planeacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_planeacion', true);
            $table->date('fecha_inicio_sesion')->nullable();
            $table->date('fecha_fin_sesion')->nullable();
            $table->text('desc_actividad')->nullable();
            $table->text('objetivo')->nullable();
            $table->text('instrucciones')->nullable();
            $table->integer('id_semestre')->nullable();
            $table->integer('id_estado')->nullable();
            $table->text('comentarios')->nullable();
            $table->text('sugerencia')->nullable();
            $table->integer('id_sugerencia')->nullable();
            $table->integer('id_estrategia')->nullable();
            $table->string('estrategia', 350)->nullable();
            $table->string('evidencia', 150)->nullable();
            $table->integer('id_evidencia')->nullable();

            $table->primary(['id_planeacion']);
        });

        Schema::table('planeacion', function (Blueprint $table) {
            $table->foreign(['id_estado'], 'fk_planeacion_id_estado')->references(['id_estado'])->on('plan_estados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_planeacion_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('planeacion');
    }
};
