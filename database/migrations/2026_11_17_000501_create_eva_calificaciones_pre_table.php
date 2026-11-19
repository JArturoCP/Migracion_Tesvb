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
        Schema::create('eva_calificaciones_pre', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id', true);
            $table->integer('id_periodo');
            $table->string('no_pregunta', 10);
            $table->double('calificacion_p')->nullable();
            $table->integer('id_hrs_profesor');
            $table->integer('id_criterio');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id']);
        });

        Schema::table('eva_calificaciones_pre', function (Blueprint $table) {
            $table->foreign(['id_criterio'], 'fk_eva_calificaciones_pre_id_criterio')->references(['id_criterio'])->on('eva_criterio')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_hrs_profesor'], 'fk_eva_calificaciones_pre_id_hrs_profesor')->references(['id_hrs_profesor'])->on('gnral_horas_profesores')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_eva_calificaciones_pre_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_calificaciones_pre');
    }
};
