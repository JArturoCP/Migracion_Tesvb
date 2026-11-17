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
        Schema::create('ar_areas_atencion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->integer('id_area_atencion', true, true);
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->boolean('activo')->default(1);
            $table->boolean('requiere_citas')->default(0);
            $table->boolean('requiere_actividades')->default(0);
            $table->boolean('maneja_datos_sensibles')->default(0);
            $table->integer('orden')->default(0);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_area_atencion']);
            $table->unique(['nombre'], 'uq_ar_areas_atencion_nombre');
            $table->index(['activo'], 'idx_ar_areas_atencion_activo');
            $table->index(['orden'], 'idx_ar_areas_atencion_orden');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ar_areas_atencion');
    }
};
