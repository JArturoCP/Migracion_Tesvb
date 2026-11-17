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
        Schema::create('beca_autorizar', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_autorizar', true);
            $table->integer('id_alumno');
            $table->integer('id_descuento');
            $table->double('promedio');
            $table->integer('id_estado');
            $table->integer('id_periodo');
            $table->integer('id_semestre');
            $table->string('fecha', 100);

            $table->primary(['id_autorizar']);
        });

        Schema::table('beca_autorizar', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_beca_autorizar_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_descuento'], 'fk_beca_autorizar_id_descuento')->references(['id_descuento'])->on('beca_descuento')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_beca_autorizar_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_semestre'], 'fk_beca_autorizar_id_semestre')->references(['id_semestre'])->on('gnral_semestres')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beca_autorizar');
    }
};
