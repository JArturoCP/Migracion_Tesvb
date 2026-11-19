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
        Schema::create('amb_estado_doc', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_estado_doc', true);
            $table->integer('id_encargado');
            $table->integer('id_periodo_amb');
            $table->integer('estado_envio');
            $table->text('fecha_registro');

            $table->primary(['id_estado_doc']);
        });

        Schema::table('amb_estado_doc', function (Blueprint $table) {
            $table->foreign(['id_encargado'], 'fk_amb_estado_doc_id_encargado')->references(['id_encargado'])->on('amb_encargados')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo_amb'], 'fk_amb_estado_doc_id_periodo_amb')->references(['id_periodo_amb'])->on('amb_periodo_amb')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('amb_estado_doc');
    }
};
