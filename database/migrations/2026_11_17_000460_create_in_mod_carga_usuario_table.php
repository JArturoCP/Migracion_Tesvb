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
        Schema::create('in_mod_carga_usuario', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_mod_carga', true);
            $table->integer('id_usuario');
            $table->timestamp('fecha_cambio')->useCurrent()->useCurrentOnUpdate();
            $table->integer('id_validar_carga');

            $table->primary(['id_mod_carga']);
        });

        Schema::table('in_mod_carga_usuario', function (Blueprint $table) {
            $table->foreign(['id_validar_carga'], 'fk_in_mod_carga_usuario_id_validar_carga')->references(['id_validar_carga'])->on('in_validar_carga')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('in_mod_carga_usuario');
    }
};
