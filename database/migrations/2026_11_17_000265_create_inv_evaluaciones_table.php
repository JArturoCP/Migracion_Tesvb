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
        Schema::create('inv_evaluaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_evaluacion', true, true);
            $table->bigInteger('id_resultado', false, true)->nullable();
            $table->integer('id_protocolo')->nullable();
            $table->integer('id_comite')->nullable();
            $table->text('comentario')->nullable();
            $table->date('fecha')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('id_asignaeva')->nullable();

            $table->primary(['id_evaluacion']);
        });

        Schema::table('inv_evaluaciones', function (Blueprint $table) {
            $table->foreign(['id_resultado'], 'fk_inv_evaluaciones_id_resultado')->references(['id_resultado'])->on('inv_resultados')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_evaluaciones');
    }
};
