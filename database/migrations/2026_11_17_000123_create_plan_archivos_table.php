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
        Schema::create('plan_archivos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id', true);
            $table->timestamp('created_at')->nullable()->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_temario')->nullable();
            $table->integer('grupo')->nullable();
            $table->text('archivo')->nullable();

            $table->primary(['id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_archivos');
    }
};
