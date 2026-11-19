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
            Schema::create('ri_estrategia_accion', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_estrategia_a', true);
                $table->integer('id_factor')->nullable();
                $table->text('accion')->nullable();
                $table->date('fecha')->nullable();
                $table->date('fecha_final');
                $table->integer('id_unidad_admin');
                $table->boolean('released')->nullable()->default(0);
                $table->string('comments', 20000)->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->text('file')->nullable();
                $table->integer('status')->nullable()->default(0);

                $table->primary(['id_estrategia_a']);
            });

            Schema::table('ri_estrategia_accion', function (Blueprint $table) {
                $table->foreign(['id_factor'], 'fk_ri_estrategia_accion_id_factor')->references(['id_factor'])->on('ri_factores')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ri_estrategia_accion');
    }
};
