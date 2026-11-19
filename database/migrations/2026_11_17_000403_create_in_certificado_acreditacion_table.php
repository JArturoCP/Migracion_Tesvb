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
        Schema::create('in_certificado_acreditacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_certificado_acreditacion', true);
            $table->text('pdf_certificado');
            $table->integer('id_alumno');
            $table->string('fecha_registro', 100);
            $table->integer('enviado');
            $table->text('fecha_envio');

            $table->primary(['id_certificado_acreditacion']);
        });

        Schema::table('in_certificado_acreditacion', function (Blueprint $table) {
            $table->foreign(['id_alumno'], 'fk_in_certificado_acreditacion_id_alumno')->references(['id_alumno'])->on('gnral_alumnos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_certificado_acreditacion');
    }
};
