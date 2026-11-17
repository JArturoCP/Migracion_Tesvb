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
        Schema::create('tu_eva_calificacion_autoeva', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_calificacion', true);
            $table->string('cal', 202);

            $table->primary(['id_calificacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_calificacion_autoeva');
    }
};
