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
            Schema::create('hrs_act_extra_clases', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_act_extra_clase', true);
                $table->string('id_hrs_actividad_extra', 50)->nullable();
                $table->string('actividad', 100)->nullable();
                $table->integer('id_carrera');
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_act_extra_clase']);
                $table->index(['id_hrs_actividad_extra'], 'idx_actividad_extra');
                $table->index(['id_carrera'], 'idx_carrera');
            });

            Schema::table('hrs_act_extra_clases', function (Blueprint $table) {
                $table->foreign(['id_carrera'], 'fk_hrs_act_extra_clases_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('hrs_act_extra_clases');
    }
};
