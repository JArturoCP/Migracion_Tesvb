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
            Schema::create('ri_evaluacion_control', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_evaluacion', true);
                $table->string('No_controles_eva', 10)->nullable();
                $table->integer('id_factor')->nullable();
                $table->text('descripcion');
                $table->integer('id_tipo_eva')->nullable();
                $table->string('documentado', 10)->nullable();
                $table->string('formalizado', 10)->nullable();
                $table->string('efectivo', 10)->nullable();
                $table->string('aplica', 10)->nullable();
                $table->string('resultado', 20)->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_evaluacion']);
            });

            Schema::table('ri_evaluacion_control', function (Blueprint $table) {
                $table->foreign(['id_factor'], 'fk_ri_evaluacion_control_id_factor')->references(['id_factor'])->on('ri_factores')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_tipo_eva'], 'fk_ri_evaluacion_control_id_tipo_eva')->references(['id_tipo_eva'])->on('ri_tipo_eva')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ri_evaluacion_control');
    }
};
