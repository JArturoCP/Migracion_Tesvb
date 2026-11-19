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
            Schema::create('in_voucher_pago', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_voucher', true);
                $table->integer('id_usuario');
                $table->text('voucher');
                $table->string('linea_captura', 30);
                $table->date('fecha_cambio');
                $table->integer('id_estado_carga_voucher')->default(0);
                $table->integer('id_estado_valida_voucher')->default(0);
                $table->integer('id_periodo_ingles');
                $table->integer('num_veces_usado')->nullable();
                $table->integer('id_tipo_voucher');
                $table->text('comentario')->nullable();
                $table->integer('estado_agregacion_excel');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_voucher']);
            });

            Schema::table('in_voucher_pago', function (Blueprint $table) {
                $table->foreign(['id_periodo_ingles'], 'fk_in_voucher_pago_id_periodo_ingles')->references(['id_periodo_ingles'])->on('in_periodos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('in_voucher_pago');
    }
};
