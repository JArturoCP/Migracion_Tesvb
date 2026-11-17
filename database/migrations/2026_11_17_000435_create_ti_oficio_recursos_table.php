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
        Schema::create('ti_oficio_recursos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_oficio_recursos', true);
            $table->string('fecha_oficio_recursos', 100);
            $table->string('numero_oficio_recursos', 100);
            $table->integer('id_alumno');

            $table->primary(['id_oficio_recursos']);
        });

        Schema::table('ti_oficio_recursos', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_ti_oficio_recursos_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ti_oficio_recursos');
    }
};
