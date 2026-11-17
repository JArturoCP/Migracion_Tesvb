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
            Schema::create('gnral_jefes_periodos', function (Blueprint $table) {
                $table->engine('InnoDB');
                $table->charset('latin1');
                $table->collation('latin1_swedish_ci');

                $table->integer('id_jefe_periodo', true);
                $table->integer('id_carrera')->nullable();
                $table->integer('id_personal')->nullable();
                $table->integer('tipo_cargo');
                $table->integer('id_periodo')->nullable();
                $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
                $table->timestamp('created_at')->default('0000-00-00 00:00:00');

                $table->primary(['id_jefe_periodo']);
                $table->index(['id_personal', 'id_periodo', 'tipo_cargo', 'id_carrera'], 'idx_ar_jefes_personal_periodo');
                $table->index(['id_carrera', 'id_periodo', 'tipo_cargo', 'id_personal'], 'idx_ar_jefes_carrera_periodo');
            });

            Schema::table('gnral_jefes_periodos', function (Blueprint $table) {
                $table->foreign(['id_carrera'], 'fk_gnral_jefes_periodos_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_periodo'], 'fk_gnral_jefes_periodos_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
                $table->foreign(['id_personal'], 'fk_gnral_jefes_periodos_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
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
        Schema::dropIfExists('gnral_jefes_periodos');
    }
};
