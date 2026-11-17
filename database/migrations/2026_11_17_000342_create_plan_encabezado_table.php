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
        Schema::create('plan_encabezado', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_encabezado', true, true);
            $table->integer('id_carrera')->nullable();
            $table->integer('id_periodo')->nullable();
            $table->integer('id_temario')->nullable();
            $table->integer('grupo')->nullable();
            $table->integer('id_personal');
            $table->date('f_inicioPlan')->nullable();
            $table->date('f_finPlan')->nullable();
            $table->text('descripcion_discapacidad')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_encabezado']);
            $table->index(['id_carrera'], 'idx_plan_encabezado_carrera');
            $table->index(['id_personal', 'id_periodo'], 'idx_plan_encabezado_personal_periodo');
        });

        Schema::table('plan_encabezado', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_plan_encabezado_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_plan_encabezado_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_plan_encabezado_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_encabezado');
    }
};
