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
        Schema::create('pres_aut_materiales_partidas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_material_partida', true);
            $table->integer('id_solicitud_partida');
            $table->text('descripcion');
            $table->string('unidad_medida', 100);
            $table->integer('cantidad');
            $table->double('precio_unitario');
            $table->double('importe');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_material_partida']);
        });

        Schema::table('pres_aut_materiales_partidas', function (Blueprint $table) {
            $table->foreign(['id_solicitud_partida'], 'fk_pres_aut_materiales_partidas_id_solicitud_partida')->references(['id_solicitud_partida'])->on('pres_aut_solicitudes_partidas')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_materiales_partidas');
    }
};
