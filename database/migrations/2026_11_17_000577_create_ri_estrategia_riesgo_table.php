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
        $sqlMode = DB::scalar('SELECT @@SESSION.sql_mode');
        DB::statement('SET SESSION sql_mode = ?', [implode(',', array_diff(explode(',', $sqlMode), ['NO_ZERO_DATE', 'NO_ZERO_IN_DATE']))]);

        try {
            Schema::create('ri_estrategia_riesgo', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_estrategia_r', true);
                $table->integer('id_estrategia')->nullable();
                $table->integer('id_reg_riesgo')->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_estrategia_r']);
            });

            Schema::table('ri_estrategia_riesgo', function (Blueprint $table) {
                $table->foreign(['id_estrategia'], 'fk_ri_estrategia_riesgo_id_estrategia')->references(['id_estrategia'])->on('ri_estrategia')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_reg_riesgo'], 'fk_ri_estrategia_riesgo_id_reg_riesgo')->references(['id_reg_riesgo'])->on('ri_registro_riesgo')->onDelete('restrict')->onUpdate('cascade');
            });
        } finally {
            DB::statement('SET SESSION sql_mode = ?', [$sqlMode]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_estrategia_riesgo');
    }
};
