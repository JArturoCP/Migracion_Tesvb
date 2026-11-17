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
        Schema::create('resi_comentarios_portada', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_comentario_portada', true);
            $table->integer('id_anteproyecto');
            $table->integer('id_profesor');
            $table->text('comentario');
            $table->integer('numero_evaluacion');
            $table->integer('id_estado_evaluacion');
            $table->integer('estado_evaluacion');

            $table->primary(['id_comentario_portada']);
        });

        Schema::table('resi_comentarios_portada', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_comentarios_portada_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_evaluacion'], 'fk_resi_comentarios_portada_id_estado_evaluacion')->references(['id_estado_evaluacion'])->on('resi_estado_evaluacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_comentarios_portada');
    }
};
