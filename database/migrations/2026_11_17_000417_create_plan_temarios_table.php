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
        Schema::create('plan_temarios', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id_temario', true, true);
            $table->integer('id_materia')->nullable();
            $table->text('competencia_d')->nullable();
            $table->text('enlace')->nullable();
            $table->text('fuentes_i')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_temario']);
            $table->index(['id_materia', 'id_temario'], 'idx_temarios_materia');
        });

        Schema::table('plan_temarios', function (Blueprint $table) {
            $table->foreign(['id_materia'], 'fk_plan_temarios_id_materia')->references(['id_materia'])->on('gnral_materias')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_temarios');
    }
};
