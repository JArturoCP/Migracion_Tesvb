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
        Schema::create('resi_proy_empresa', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_proy_empresa', true);
            $table->integer('id_empresa');
            $table->integer('id_anteproyecto');
            $table->string('asesor', 200);
            $table->string('puesto', 200);
            $table->text('informacion_empresa');
            $table->integer('id_giro');
            $table->integer('id_sector');

            $table->primary(['id_proy_empresa']);
        });

        Schema::table('resi_proy_empresa', function (Blueprint $table) {
            $table->foreign(['id_anteproyecto'], 'fk_resi_proy_empresa_id_anteproyecto')->references(['id_anteproyecto'])->on('resi_anteproyecto')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_empresa'], 'fk_resi_proy_empresa_id_empresa')->references(['id_empresa'])->on('resi_empresa')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_giro'], 'fk_resi_proy_empresa_id_giro')->references(['id_giro'])->on('resi_giro')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_sector'], 'fk_resi_proy_empresa_id_sector')->references(['id_sector'])->on('resi_sector')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_proy_empresa');
    }
};
