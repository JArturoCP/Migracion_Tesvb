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
        Schema::create('aud_notas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_notas', true);
            $table->integer('id_reporte');
            $table->string('punto_proceso', 50);
            $table->text('observaciones');
            $table->integer('id_clasificacion');
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at')->nullable();
            $table->tinyInteger('autorizacion');
            $table->text('resultado');
            $table->integer('dias')->nullable();
            $table->string('clave_nota', 255)->nullable();

            $table->primary(['id_notas']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `aud_notas` MODIFY `autorizacion` bit(2) NOT NULL');

        Schema::table('aud_notas', function (Blueprint $table) {
            $table->foreign(['id_clasificacion'], 'fk_aud_notas_id_clasificacion')->references(['id_clasificacion'])->on('aud_clasificacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_reporte'], 'fk_aud_notas_id_reporte')->references(['id_reporte'])->on('aud_reportes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_notas');
    }
};
