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
        Schema::create('pres_presupuesto_anteproyecto', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_presupuesto', true);
            $table->integer('id_proyecto');
            $table->integer('year');
            $table->string('fecha_registro', 100);
            $table->string('fecha_mod', 100);

            $table->primary(['id_presupuesto']);
        });

        Schema::table('pres_presupuesto_anteproyecto', function (Blueprint $table) {
            $table->foreign(['id_proyecto'], 'fk_pres_presupuesto_anteproyecto_id_proyecto')->references(['id_proyecto'])->on('pres_proyectos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_presupuesto_anteproyecto');
    }
};
