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
        Schema::create('exp_asigna_generacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_generacion', true);
            $table->integer('id_generacion')->nullable();
            $table->integer('grupo')->nullable();
            $table->integer('id_jefe_periodo');
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_generacion']);
            $table->index(['id_generacion'], 'grupgen_idx');
        });

        Schema::table('exp_asigna_generacion', function (Blueprint $table) {
            $table->foreign(['id_generacion'], 'fk_exp_asigna_generacion_id_generacion')->references(['id_generacion'])->on('exp_generacion')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_jefe_periodo'], 'fk_exp_asigna_generacion_id_jefe_periodo')->references(['id_jefe_periodo'])->on('gnral_jefes_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exp_asigna_generacion');
    }
};
