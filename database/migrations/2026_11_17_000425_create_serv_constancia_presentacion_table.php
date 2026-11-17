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
        Schema::create('serv_constancia_presentacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_constancia_presentacion', true);
            $table->integer('id_estado_envio');
            $table->text('comentario');
            $table->text('pdf_constancia_presentacion');
            $table->integer('id_periodo');
            $table->integer('id_alumno');

            $table->primary(['id_constancia_presentacion']);
        });

        Schema::table('serv_constancia_presentacion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_serv_constancia_presentacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_periodo'], 'fk_serv_constancia_presentacion_id_periodo')->references(['id_periodo'])->on('serv_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('serv_constancia_presentacion');
    }
};
