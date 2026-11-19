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
        Schema::create('ar_actividad_categorias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_categoria_actividad', true, true);
            $table->string('nombre', 150);
            $table->string('descripcion', 255)->nullable();
            $table->boolean('activo')->default(1);
            $table->integer('orden')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_categoria_actividad']);
            $table->unique(['nombre'], 'uq_ar_actividad_categorias_nombre');
            $table->index(['activo'], 'idx_ar_actividad_categorias_activo');
            $table->index(['orden'], 'idx_ar_actividad_categorias_orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_actividad_categorias');
    }
};
