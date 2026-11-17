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
            Schema::create('ri_factores', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_factor', true);
                $table->integer('no_factor')->nullable();
                $table->integer('id_reg_riesgo')->nullable();
                $table->text('descripcion_f')->nullable();
                $table->integer('id_cl_f')->nullable();
                $table->integer('id_tipo_f')->nullable();
                $table->string('tiene_controles', 2)->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_factor']);
            });

            Schema::table('ri_factores', function (Blueprint $table) {
                $table->foreign(['id_cl_f'], 'fk_ri_factores_id_cl_f')->references(['id_cl_f'])->on('ri_clasif_factor')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_reg_riesgo'], 'fk_ri_factores_id_reg_riesgo')->references(['id_reg_riesgo'])->on('ri_registro_riesgo')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_tipo_f'], 'fk_ri_factores_id_tipo_f')->references(['id_tipo_f'])->on('ri_tipo_f')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('ri_factores');
    }
};
