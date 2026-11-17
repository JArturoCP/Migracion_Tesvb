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
        Schema::create('exp_asigna_coordinador', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_coordinador', true);
            $table->integer('id_jefe_periodo')->nullable();
            $table->integer('id_personal')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_coordinador']);
            $table->index(['id_jefe_periodo'], 'jefeperd_idx');
            $table->index(['id_personal'], 'pers_idx');
        });

        Schema::table('exp_asigna_coordinador', function (Blueprint $table) {
            $table->foreign(['id_jefe_periodo'], 'fk_exp_asigna_coordinador_id_jefe_periodo')->references(['id_jefe_periodo'])->on('gnral_jefes_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_exp_asigna_coordinador_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_asigna_coordinador');
    }
};
