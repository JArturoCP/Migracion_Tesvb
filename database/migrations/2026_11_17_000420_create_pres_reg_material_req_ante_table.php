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
        Schema::create('pres_reg_material_req_ante', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_reg_material_ant', true);
            $table->integer('id_actividades_req_ante');
            $table->text('descripcion');
            $table->text('unidad_medida');
            $table->integer('cantidad');
            $table->double('precio_unitario');
            $table->double('importe');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);

            $table->primary(['id_reg_material_ant']);
        });

        Schema::table('pres_reg_material_req_ante', function (Blueprint $table) {
            $table->foreign(['id_actividades_req_ante'], 'fk_pres_reg_material_req_ante_id_actividades_req_ante')->references(['id_actividades_req_ante'])->on('pres_actividades_req_ante')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_reg_material_req_ante');
    }
};
