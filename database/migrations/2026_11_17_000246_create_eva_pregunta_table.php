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
        Schema::create('eva_pregunta', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_general_ci');

            $table->integer('no_pregunta');
            $table->string('descripcion', 500);
            $table->integer('id_criterio');
            $table->integer('tipo')->nullable();
            $table->text('recomendaciones');
            $table->text('felicitaciones');

            $table->primary(['no_pregunta']);
        });

        Schema::table('eva_pregunta', function (Blueprint $table) {
            $table->foreign(['id_criterio'], 'fk_eva_pregunta_id_criterio')->references(['id_criterio'])->on('eva_criterio')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eva_pregunta');
    }
};
