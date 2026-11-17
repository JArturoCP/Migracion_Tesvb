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
        Schema::create('inc_solicitudes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_solicitud', true);
            $table->dateTime('fecha_solicitud');
            $table->integer('id_articulo')->nullable();
            $table->date('fecha_req')->nullable();
            $table->string('motivo_oficio', 255)->nullable();
            $table->string('hora_e', 20)->nullable();
            $table->string('hora_st', 20)->nullable();
            $table->date('fecha_invac')->nullable();
            $table->date('fecha_tervac')->nullable();
            $table->string('Ingreso_a_la_institución', 20)->nullable();
            $table->string('hora_e1', 20)->nullable();
            $table->string('hora_s1', 20)->nullable();
            $table->string('hora_e2', 20)->nullable();
            $table->string('hora_s2', 100)->nullable();
            $table->integer('id_estado_solicitud');
            $table->integer('id_personal');
            $table->integer('id_jefe');
            $table->integer('directora')->nullable();
            $table->integer('direc_finanzas');
            $table->text('arch_solicitud');
            $table->dateTime('updated_at');
            $table->timestamp('created_at')->useCurrent()->useCurrentOnUpdate();

            $table->primary(['id_solicitud']);
        });

        Schema::table('inc_solicitudes', function (Blueprint $table) {
            $table->foreign(['id_articulo'], 'fk_inc_solicitudes_id_articulo')->references(['id_articulo'])->on('inc_articulos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_estado_solicitud'], 'fk_inc_solicitudes_id_estado_solicitud')->references(['id_estado_solicitud'])->on('inc_estado_solicitud')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_inc_solicitudes_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inc_solicitudes');
    }
};
