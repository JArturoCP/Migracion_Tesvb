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
            Schema::create('ri__reg_oportunidad', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_oportunidad', true);
                $table->string('des_oportunidad', 200)->nullable();
                $table->integer('id_probabilidad')->nullable();
                $table->integer('id_ocurrenciap')->nullable();
                $table->integer('calificacion')->nullable();
                $table->integer('id_potencialapertura')->nullable();
                $table->integer('id_potencialcrecimiento')->nullable();
                $table->integer('id_mejoracliente')->nullable();
                $table->integer('id_mejorasgc')->nullable();
                $table->integer('id_mejorareputacion')->nullable();
                $table->integer('id_potencialcosto')->nullable();
                $table->integer('calif_beneficio')->nullable();
                $table->integer('factor_oportunidad')->nullable();
                $table->integer('id_requisito');
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');
                $table->integer('id_unidad_admin')->nullable();

                $table->primary(['id_oportunidad']);
            });

            Schema::table('ri__reg_oportunidad', function (Blueprint $table) {
                $table->foreign(['id_mejoracliente'], 'fk_ri__reg_oportunidad_id_mejoracliente')->references(['id_mejoracliente'])->on('ri_o_mejoracliente')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_mejorareputacion'], 'fk_ri__reg_oportunidad_id_mejorareputacion')->references(['id_mejorareputacion'])->on('ri_o_mejorareputacion')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_mejorasgc'], 'fk_ri__reg_oportunidad_id_mejorasgc')->references(['id_mejorasgc'])->on('ri_o_mejorasgc')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_ocurrenciap'], 'fk_ri__reg_oportunidad_id_ocurrenciap')->references(['id_ocurrenciap'])->on('ri_o_ocurrenciasp')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_potencialapertura'], 'fk_ri__reg_oportunidad_id_potencialapertura')->references(['id_potencialapertura'])->on('ri_o_potencialapertura')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_potencialcosto'], 'fk_ri__reg_oportunidad_id_potencialcosto')->references(['id_potencialcosto'])->on('ri_o_potencialcosto')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_potencialcrecimiento'], 'fk_ri__reg_oportunidad_id_potencialcrecimiento')->references(['id_potencialcrecimiento'])->on('ri_o_potencialcrecimiento')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_probabilidad'], 'fk_ri__reg_oportunidad_id_probabilidad')->references(['id_probabilidad'])->on('ri_o_probabilidad')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_requisito'], 'fk_ri__reg_oportunidad_id_requisito')->references(['id_requisito'])->on('ri_requisitos')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ri__reg_oportunidad');
    }
};
