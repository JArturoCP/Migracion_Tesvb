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
        Schema::create('plan_proyecto_practicas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_plan_proyecto_practica', true, true);
            $table->integer('id_unidad');
            $table->integer('grupo');
            $table->text('Descripcion_p')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_encabezado')->nullable();

            $table->primary(['id_plan_proyecto_practica']);
            $table->index(['id_encabezado', 'id_unidad', 'grupo'], 'idx_ppp_encabezado_unidad_grupo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_proyecto_practicas');
    }
};
