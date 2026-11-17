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
        Schema::create('plan_estra_sesion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->integer('id_estra_sesion', true);
            $table->integer('id_estrategia');
            $table->integer('id_secuencia');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_estra_sesion']);
            $table->index(['id_secuencia'], 'idx_pes_id_secuencia');
            $table->index(['id_secuencia', 'id_estrategia'], 'idx_pes_secuencia_estrategia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_estra_sesion');
    }
};
