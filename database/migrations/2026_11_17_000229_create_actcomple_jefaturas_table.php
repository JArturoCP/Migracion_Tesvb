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
        Schema::create('actcomple_jefaturas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_jefatura', true);
            $table->string('nom_jefatura', 70)->nullable();
            $table->integer('id_carrera')->nullable();

            $table->primary(['id_jefatura']);
        });

        Schema::table('actcomple_jefaturas', function (Blueprint $table) {
            $table->foreign(['id_carrera'], 'fk_actcomple_jefaturas_id_carrera')->references(['id_carrera'])->on('gnral_carreras')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actcomple_jefaturas');
    }
};
