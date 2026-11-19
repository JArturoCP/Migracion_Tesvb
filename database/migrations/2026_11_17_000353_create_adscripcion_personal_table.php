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
        Schema::create('adscripcion_personal', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_adscripcion', true);
            $table->integer('id_personal');
            $table->integer('id_unidad_persona');

            $table->primary(['id_adscripcion']);
        });

        Schema::table('adscripcion_personal', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_adscripcion_personal_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_unidad_persona'], 'fk_adscripcion_personal_id_unidad_persona')->references(['id_unidad_persona'])->on('gnral_unidad_personal')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adscripcion_personal');
    }
};
