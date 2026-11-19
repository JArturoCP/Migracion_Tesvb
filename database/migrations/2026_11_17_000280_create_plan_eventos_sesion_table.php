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
        Schema::create('plan_eventos_sesion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_evento_sesion', true);
            $table->integer('id_evento')->nullable();
            $table->integer('id_secuencia')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_unidad')->nullable();

            $table->primary(['id_evento_sesion']);
            $table->index(['id_secuencia', 'id_evento', 'id_unidad'], 'idx_pes_eventos_secuencia_evento_unidad');
        });

        Schema::table('plan_eventos_sesion', function (Blueprint $table) {
            $table->foreign(['id_evento'], 'fk_plan_eventos_sesion_id_evento')->references(['id_evento'])->on('plan_eventos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_eventos_sesion');
    }
};
