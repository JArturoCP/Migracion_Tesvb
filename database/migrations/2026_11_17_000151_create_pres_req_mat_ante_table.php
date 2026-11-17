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
        Schema::create('pres_req_mat_ante', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_req_mat_ante', true);
            $table->integer('id_unidad_admin');
            $table->integer('year_requisicion');
            $table->integer('id_estado_requisicion');
            $table->integer('numero_requisicion');
            $table->string('fecha_registro', 100);
            $table->string('fecha_envio', 100);

            $table->primary(['id_req_mat_ante']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_req_mat_ante');
    }
};
