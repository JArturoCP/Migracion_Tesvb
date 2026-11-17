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
        Schema::create('tu_eva_fo17_des', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('ucs2');
            $table->collation('ucs2_spanish2_ci');

            $table->integer('id_des', true);
            $table->string('des', 2);

            $table->primary(['id_des']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tu_eva_fo17_des');
    }
};
