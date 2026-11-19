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
        Schema::create('tu_eva_cuestionario', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_eva_cuestionario', true);
            $table->integer('id_eva_categoria_cuestionario');
            $table->string('descripcion', 200);

            $table->primary(['id_eva_cuestionario']);
        });

        Schema::table('tu_eva_cuestionario', function (Blueprint $table) {
            $table->foreign(['id_eva_categoria_cuestionario'], 'fk_tu_eva_cuestionario_id_eva_categoria_cuestionario')->references(['id_eva_categoria_cuestionario'])->on('tu_eva_categoria_cuestionario')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_cuestionario');
    }
};
