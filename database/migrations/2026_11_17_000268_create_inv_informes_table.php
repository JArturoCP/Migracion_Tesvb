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
            Schema::create('inv_informes', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('utf8mb4');
                $table->collation('utf8mb4_general_ci');

                $table->bigInteger('id_informe', true);
                $table->bigInteger('id_protocolo')->nullable();
                $table->bigInteger('id_tipo_informe')->nullable();
                $table->date('periodo_inicio')->nullable();
                $table->date('periodo_fin')->nullable();
                $table->timestamp('fecha_elaboracion')->nullable();
                $table->text('observaciones')->nullable();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
                $table->timestamp('deleted_at')->nullable();
                $table->integer('id_periodo_envio_inf')->nullable();

                $table->primary(['id_informe']);
            });

            Schema::table('inv_informes', function (Blueprint $table) {
                $table->foreign(['id_tipo_informe'], 'fk_inv_informes_id_tipo_informe')->references(['id_tipo_informe'])->on('inv_tipo_informes')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('inv_informes');
    }
};
