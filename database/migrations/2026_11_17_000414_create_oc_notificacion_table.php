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
        Schema::create('oc_notificacion', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_notificacion', true);
            $table->integer('id_usuario');
            $table->integer('id_oficio_personal');

            $table->primary(['id_notificacion']);
        });

        Schema::table('oc_notificacion', function (Blueprint $table) {
            $table->foreign(['id_oficio_personal'], 'fk_oc_notificacion_id_oficio_personal')->references(['id_oficio_personal'])->on('oc_oficio_personal')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oc_notificacion');
    }
};
