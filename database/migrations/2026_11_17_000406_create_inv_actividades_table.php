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
        Schema::create('inv_actividades', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_actividad', true, true);
            $table->bigInteger('id_protocolo', false, true);
            $table->string('descripcion', 250);
            $table->string('etiqueta', 50);
            $table->date('f_inicial');
            $table->date('f_final');
            $table->double('monto_solicitado')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->boolean('colaboracion')->nullable();

            $table->primary(['id_actividad']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `inv_actividades` MODIFY `monto_solicitado` double(8,2) DEFAULT NULL');

        Schema::table('inv_actividades', function (Blueprint $table) {
            $table->foreign(['id_protocolo'], 'fk_inv_actividades_id_protocolo')->references(['id_protocolo'])->on('inv_protocolos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_actividades');
    }
};
