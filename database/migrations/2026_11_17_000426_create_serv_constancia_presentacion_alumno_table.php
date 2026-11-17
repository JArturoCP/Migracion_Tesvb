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
        Schema::create('serv_constancia_presentacion_alumno', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_constancia_presentacion_alumno', true);
            $table->integer('id_alumno');
            $table->text('pdf_carta_presentacion');
            $table->text('comentario_departamento');
            $table->string('fecha_registro', 100);

            $table->primary(['id_constancia_presentacion_alumno']);
        });

        Schema::table('serv_constancia_presentacion_alumno', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_serv_constancia_presentacion_alumno_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serv_constancia_presentacion_alumno');
    }
};
