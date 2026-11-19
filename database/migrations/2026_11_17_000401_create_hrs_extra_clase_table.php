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
            Schema::create('hrs_extra_clase', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_extra_clase', true);
                $table->integer('id_act_extra_clase')->nullable();
                $table->integer('id_horario_profesor')->nullable();
                $table->string('grupo', 20);
                $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('updated_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_extra_clase']);
                $table->index(['id_horario_profesor'], 'idx_horario_profesor');
                $table->index(['id_act_extra_clase'], 'idx_act_extra_clase');
            });

            Schema::table('hrs_extra_clase', function (Blueprint $table) {
                $table->foreign(['id_act_extra_clase'], 'fk_hrs_extra_clase_id_act_extra_clase')->references(['id_act_extra_clase'])->on('hrs_act_extra_clases')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_horario_profesor'], 'fk_hrs_extra_clase_id_horario_profesor')->references(['id_horario_profesor'])->on('gnral_horarios')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('hrs_extra_clase');
    }
};
