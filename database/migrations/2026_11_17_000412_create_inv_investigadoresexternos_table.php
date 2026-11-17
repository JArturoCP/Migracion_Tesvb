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
        Schema::create('inv_investigadoresexternos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_investigadorexterno', true, true);
            $table->bigInteger('id_protocolo', false, true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('nombre', 200)->nullable();
            $table->integer('id_proyectov')->nullable();

            $table->primary(['id_investigadorexterno']);
        });

        Schema::table('inv_investigadoresexternos', function (Blueprint $table) {
            $table->foreign(['id_protocolo'], 'fk_inv_investigadoresexternos_id_protocolo')->references(['id_protocolo'])->on('inv_protocolos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_proyectov'], 'fk_inv_investigadoresexternos_id_proyectov')->references(['id_proyectov'])->on('inv_proyectosvinculacion')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_investigadoresexternos');
    }
};
