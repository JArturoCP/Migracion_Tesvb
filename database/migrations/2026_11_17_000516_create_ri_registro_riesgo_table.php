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
            Schema::create('ri_registro_riesgo', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_reg_riesgo', true);
                $table->string('numero', 11)->nullable();
                $table->integer('id_unidad_admin')->nullable();
                $table->integer('id_seleccion');
                $table->text('descip_riesgo')->nullable();
                $table->integer('id_riesgo');
                $table->integer('id_nivel_des')->nullable();
                $table->integer('id_cl_r')->nullable();
                $table->timestamp('fecha')->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_reg_riesgo']);
            });

            Schema::table('ri_registro_riesgo', function (Blueprint $table) {
                $table->foreign(['id_cl_r'], 'fk_ri_registro_riesgo_id_cl_r')->references(['id_cl_r'])->on('ri_clasif_r')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_riesgo'], 'fk_ri_registro_riesgo_id_riesgo')->references(['id_riesgo'])->on('ri_riesgo')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_seleccion'], 'fk_ri_registro_riesgo_id_seleccion')->references(['id_seleccion'])->on('ri_seleccion')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ri_registro_riesgo');
    }
};
