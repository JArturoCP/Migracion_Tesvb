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
        Schema::create('pres_metas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_meta', true);
            $table->text('meta');
            $table->integer('id_proyecto');
            $table->text('fecha_registro');
            $table->text('fecha_modificacion');

            $table->primary(['id_meta']);
        });

        Schema::table('pres_metas', function (Blueprint $table) {
            $table->foreign(['id_proyecto'], 'fk_pres_metas_id_proyecto')->references(['id_proyecto'])->on('pres_proyectos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_metas');
    }
};
