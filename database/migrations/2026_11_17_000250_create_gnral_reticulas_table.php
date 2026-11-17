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
            Schema::create('gnral_reticulas', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_reticula', true);
                $table->string('clave', 20);
                $table->integer('id_carrera');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_reticula']);
                $table->index(['id_carrera', 'id_reticula'], 'idx_reticulas_carrera');
            });

            Schema::table('gnral_reticulas', function (Blueprint $table) {
                $table->foreign(['id_carrera'], 'fk_gnral_reticulas_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('gnral_reticulas');
    }
};
