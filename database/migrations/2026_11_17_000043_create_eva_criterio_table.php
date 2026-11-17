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
        Schema::create('eva_criterio', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_general_ci');

            $table->integer('id_criterio');
            $table->string('nombre_criterio', 100);
            $table->string('color', 20);

            $table->primary(['id_criterio']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_criterio');
    }
};
