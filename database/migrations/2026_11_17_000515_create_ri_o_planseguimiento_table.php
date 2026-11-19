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
        Schema::create('ri_o_planseguimiento', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_planseguimiento', true);
            $table->text('des_planseguimiento')->nullable();
            $table->integer('id_oportunidad')->nullable();
            $table->date('fecha_inicial');
            $table->date('fecha')->nullable();
            $table->boolean('released')->nullable()->default(0);
            $table->string('comments', 20000)->nullable();
            $table->date('created_at');
            $table->date('updated_at');
            $table->text('file')->nullable();
            $table->integer('status')->nullable();

            $table->primary(['id_planseguimiento']);
        });

        Schema::table('ri_o_planseguimiento', function (Blueprint $table) {
            $table->foreign(['id_oportunidad'], 'fk_ri_o_planseguimiento_id_oportunidad')->references(['id_oportunidad'])->on('ri__reg_oportunidad')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_o_planseguimiento');
    }
};
