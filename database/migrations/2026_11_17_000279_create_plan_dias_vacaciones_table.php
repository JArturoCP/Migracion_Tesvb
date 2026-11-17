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
        Schema::create('plan_dias_vacaciones', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_vacaciones', true, true);
            $table->date('f_inicio');
            $table->date('f_final');
            $table->integer('id_periodo');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_vacaciones']);
        });

        Schema::table('plan_dias_vacaciones', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_plan_dias_vacaciones_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_dias_vacaciones');
    }
};
