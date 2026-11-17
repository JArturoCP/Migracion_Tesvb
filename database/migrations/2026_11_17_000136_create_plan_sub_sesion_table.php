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
        Schema::create('plan_sub_sesion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_subtema_sesion', true, true);
            $table->integer('id_subtema');
            $table->integer('id_secuencia');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_subtema_sesion']);
            $table->index(['id_secuencia'], 'idx_pss_id_secuencia');
            $table->index(['id_secuencia', 'id_subtema'], 'idx_pss_secuencia_subtema');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_sub_sesion');
    }
};
