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
        Schema::create('in_estado_voucher_aut_excel', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_estado_voucher_aut_excel', true);
            $table->integer('estado');
            $table->integer('id_periodo_ingles');
            $table->string('fecha_registro', 100);

            $table->primary(['id_estado_voucher_aut_excel']);
        });

        Schema::table('in_estado_voucher_aut_excel', function (Blueprint $table) {
            $table->foreign(['id_periodo_ingles'], 'fk_in_estado_voucher_aut_excel_id_periodo_ingles')->references(['id_periodo_ingles'])->on('in_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_estado_voucher_aut_excel');
    }
};
