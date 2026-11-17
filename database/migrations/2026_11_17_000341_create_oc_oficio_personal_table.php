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
        Schema::create('oc_oficio_personal', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_oficio_personal', true);
            $table->string('anio', 10);
            $table->integer('id_oficio');
            $table->integer('id_personal');
            $table->integer('viaticos');
            $table->integer('automovil');
            $table->integer('id_notificacion');
            $table->integer('no_oficio');
            $table->integer('estado_oficio');
            $table->date('fecha_salida');
            $table->date('fecha_regreso');

            $table->primary(['id_oficio_personal']);
        });

        Schema::table('oc_oficio_personal', function (Blueprint $table) {
            $table->foreign(['id_notificacion'], 'fk_oc_oficio_personal_id_notificacion')->references(['id_notificacion'])->on('oc_estado_oficio')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_oficio'], 'fk_oc_oficio_personal_id_oficio')->references(['id_oficio'])->on('oc_oficio')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal'], 'fk_oc_oficio_personal_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oc_oficio_personal');
    }
};
