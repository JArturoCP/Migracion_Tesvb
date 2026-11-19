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
            Schema::create('pmcodigos_material', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb4');
                $table->collation('utf8mb4_general_ci');

                $table->integer('id_codigo', true);
                $table->integer('id_material');
                $table->string('codigo', 100);
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->timestamp('deleted_at')->nullable();

                $table->primary(['id_codigo']);
                $table->unique(['codigo', 'deleted_at'], 'codigo_unico_activo');
            });

            Schema::table('pmcodigos_material', function (Blueprint $table) {
                $table->foreign(['id_material'], 'fk_pmcodigos_material_id_material')->references(['id_material'])->on('pmprestamos_materiales')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('pmcodigos_material');
    }
};
