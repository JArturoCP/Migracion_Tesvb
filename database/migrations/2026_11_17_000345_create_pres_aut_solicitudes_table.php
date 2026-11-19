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
        Schema::create('pres_aut_solicitudes', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_solicitud', true);
            $table->integer('year_presupuesto');
            $table->integer('id_unidad_admin');
            $table->integer('id_estado_enviado');
            $table->integer('numero_solicitud');
            $table->integer('id_proyecto');
            $table->integer('id_meta');
            $table->integer('id_mes');
            $table->text('descripcion_solicitud');
            $table->text('comentario_solicitud');
            $table->string('fecha_registro', 100);
            $table->string('fecha_modificacion', 100);
            $table->string('fecha_enviado', 100);

            $table->primary(['id_solicitud']);
        });

        Schema::table('pres_aut_solicitudes', function (Blueprint $table) {
            $table->foreign(['id_mes'], 'fk_pres_aut_solicitudes_id_mes')->references(['id_mes'])->on('pres_mes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_meta'], 'fk_pres_aut_solicitudes_id_meta')->references(['id_meta'])->on('pres_metas')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_proyecto'], 'fk_pres_aut_solicitudes_id_proyecto')->references(['id_proyecto'])->on('pres_proyectos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pres_aut_solicitudes');
    }
};
