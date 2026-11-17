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
            Schema::create('inv_asigna_eva_inf', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb4');
                $table->collation('utf8mb4_general_ci');

                $table->bigInteger('id_asigna_eval_inf', true);
                $table->bigInteger('id_asigna_informes')->nullable();
                $table->bigInteger('id_pregunta')->nullable();
                $table->bigInteger('id_resultado')->nullable();
                $table->text('valor')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->timestamp('deleted_at')->nullable();

                $table->primary(['id_asigna_eval_inf']);
            });

            Schema::table('inv_asigna_eva_inf', function (Blueprint $table) {
                $table->foreign(['id_asigna_informes'], 'fk_inv_asigna_eva_inf_id_asigna_informes')->references(['id_asigna_informes'])->on('inv_asigna_informes')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_pregunta'], 'fk_inv_asigna_eva_inf_id_pregunta')->references(['id_pregunta'])->on('inv_preg_informes')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('inv_asigna_eva_inf');
    }
};
