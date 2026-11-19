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
            Schema::create('inv_seguimiento_act', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb4');
                $table->collation('utf8mb4_general_ci');

                $table->bigInteger('id_seguimiento_act', true);
                $table->bigInteger('id_informe')->nullable();
                $table->bigInteger('id_estado_meta_act')->nullable();
                $table->bigInteger('id_actividad')->nullable();
                $table->string('documento', 250)->nullable();
                $table->integer('cantidad_lograda')->nullable();
                $table->text('justificacion')->nullable();
                $table->text('comentario')->nullable();
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->timestamp('deleted_at')->nullable();

                $table->primary(['id_seguimiento_act']);
            });

            Schema::table('inv_seguimiento_act', function (Blueprint $table) {
                $table->foreign(['id_estado_meta_act'], 'fk_inv_seguimiento_act_id_estado_meta_act')->references(['id_estado_meta_act'])->on('inv_estados_metas_act')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_informe'], 'fk_inv_seguimiento_act_id_informe')->references(['id_informe'])->on('inv_informes')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('inv_seguimiento_act');
    }
};
