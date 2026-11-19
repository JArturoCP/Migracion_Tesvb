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
        Schema::create('ar_actividad_catalogo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_actividad_catalogo', true, true);
            $table->integer('id_categoria_actividad', false, true);
            $table->string('nombre', 180);
            $table->text('descripcion')->nullable();
            $table->boolean('activo')->default(1);
            $table->integer('orden')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_actividad_catalogo']);
            $table->index(['id_categoria_actividad'], 'idx_ar_actividad_catalogo_categoria');
            $table->index(['activo'], 'idx_ar_actividad_catalogo_activo');
            $table->index(['orden'], 'idx_ar_actividad_catalogo_orden');
        });

        Schema::table('ar_actividad_catalogo', function (Blueprint $table) {
            $table->foreign(['id_categoria_actividad'], 'fk_ar_actividad_catalogo_id_categoria_actividad')->references(['id_categoria_actividad'])->on('ar_actividad_categorias')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_actividad_catalogo');
    }
};
