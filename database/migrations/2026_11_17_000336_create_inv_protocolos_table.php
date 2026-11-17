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
        Schema::create('inv_protocolos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_protocolo', true, true);
            $table->bigInteger('id_investigador', false, true);
            $table->bigInteger('id_convocatoria', false, true);
            $table->bigInteger('id_linea', false, true);
            $table->text('titulo');
            $table->text('resumen');
            $table->date('f_inicio');
            $table->date('f_fin');
            $table->string('clave_registro', 250)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->integer('estado');
            $table->text('solicitar_ampliacion')->nullable();
            $table->date('fecha_ampliacion')->nullable();
            $table->text('acuerdo')->nullable();

            $table->primary(['id_protocolo']);
        });

        Schema::table('inv_protocolos', function (Blueprint $table) {
            $table->foreign(['id_convocatoria'], 'fk_inv_protocolos_id_convocatoria')->references(['id_convocatoria'])->on('inv_convocatorias')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_investigador'], 'fk_inv_protocolos_id_investigador')->references(['id_investigador'])->on('inv_investigadores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_linea'], 'fk_inv_protocolos_id_linea')->references(['id_linea'])->on('inv_lineas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_protocolos');
    }
};
