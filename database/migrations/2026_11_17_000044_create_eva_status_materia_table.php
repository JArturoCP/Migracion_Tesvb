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
        Schema::create('eva_status_materia', function (Blueprint $table) {
            $table->engine('MyISAM');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_status_materia')->nullable();
            $table->string('nombre_status', 55)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_status_materia');
    }
};
