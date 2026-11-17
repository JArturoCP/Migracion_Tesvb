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
        Schema::create('plan_factores', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->integer('id_factor', true, true);
            $table->string('desc_factor', 255);
            $table->integer('id_eje')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_factor']);
            $table->index(['id_factor', 'id_eje'], 'idx_pf_factor_eje');
        });

        Schema::table('plan_factores', function (Blueprint $table) {
            $table->foreign(['id_eje'], 'fk_plan_factores_id_eje')->references(['id'])->on('plan_ejes')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_factores');
    }
};
