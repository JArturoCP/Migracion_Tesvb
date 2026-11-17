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
        Schema::create('situacion', function (Blueprint $table) {
            $table->engine('MyISAM');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_situacion', true);
            $table->string('situacion', 30)->nullable();
            $table->string('abrevia', 5);

            $table->primary(['id_situacion']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('situacion');
    }
};
