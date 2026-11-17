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
        Schema::create('cal_plan', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_plan', true);
            $table->string('plan', 100);
            $table->integer('id_carrera');

            $table->primary(['id_plan']);
        });

        Schema::table('cal_plan', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_cal_plan_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cal_plan');
    }
};
