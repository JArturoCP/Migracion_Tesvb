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
        Schema::create('plan_sistema_evaluacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_sistema_evaluacion', true, true);
            $table->integer('id_unidad')->nullable();
            $table->integer('id_encabezado');
            $table->integer('id_factor');
            $table->text('ponderacion');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_sistema_evaluacion']);
            $table->index(['id_encabezado', 'id_unidad'], 'idx_pse_encabezado_unidad');
            $table->index(['id_encabezado', 'id_unidad', 'id_factor'], 'idx_pse_encabezado_unidad_factor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_sistema_evaluacion');
    }
};
