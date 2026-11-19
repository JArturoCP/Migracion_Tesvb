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
        Schema::create('ti_historial_mod_descuento_alum', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_historial_desc', true);
            $table->integer('id_personal');
            $table->integer('id_descuento_alumn');
            $table->text('accion');
            $table->text('fecha_mod');
            $table->text('fecha_anterior');
            $table->text('fecha_actual');
            $table->integer('id_tipo_desc');
            $table->string('telefono', 10);
            $table->integer('id_nacionalidad');
            $table->integer('id_preparatoria');

            $table->primary(['id_historial_desc']);
        });

        Schema::table('ti_historial_mod_descuento_alum', function (Blueprint $table) {
            $table->foreign(['id_descuento_alumn'], 'fk_ti_historial_mod_descuento_alum_id_descuento_alumn')->references(['id_descuento_alum'])->on('ti_descuentos_alum')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_nacionalidad'], 'fk_ti_historial_mod_descuento_alum_id_nacionalidad')->references(['id_nacionalidad'])->on('ti_nacionalidad')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_ti_historial_mod_descuento_alum_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_preparatoria'], 'fk_ti_historial_mod_descuento_alum_id_preparatoria')->references(['id_preparatoria'])->on('ti_preparatatoria')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_tipo_desc'], 'fk_ti_historial_mod_descuento_alum_id_tipo_desc')->references(['id_tipo_desc'])->on('ti_tipos_desc')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_historial_mod_descuento_alum');
    }
};
