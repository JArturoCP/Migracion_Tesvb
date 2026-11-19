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
        Schema::create('in_bitacora_periodo', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_bitacora_periodo', true);
            $table->integer('id_unidad');
            $table->integer('id_nivel');
            $table->integer('id_grupo');
            $table->date('fecha_anterior');
            $table->date('fecha_registrada');
            $table->timestamp('fecha_modificacion')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_periodo');
            $table->integer('id_profesor');

            $table->primary(['id_bitacora_periodo']);
        });

        Schema::table('in_bitacora_periodo', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'fk_in_bitacora_periodo_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_in_bitacora_periodo_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad'], 'fk_in_bitacora_periodo_id_unidad')->references(['id_unidad'])->on('cal_unidades')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_bitacora_periodo');
    }
};
