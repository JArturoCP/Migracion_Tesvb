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
        Schema::create('tu_eva_fo17_cal', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('ucs2');
            $table->collation('ucs2_spanish2_ci');

            $table->integer('id_cal', true);
            $table->string('cal', 20);

            $table->primary(['id_cal']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_fo17_cal');
    }
};
