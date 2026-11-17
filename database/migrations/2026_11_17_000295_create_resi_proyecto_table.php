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
        Schema::create('resi_proyecto', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_proyecto', true);
            $table->text('nom_proyecto');
            $table->integer('id_tipo_proyecto');

            $table->primary(['id_proyecto']);
        });

        Schema::table('resi_proyecto', function (Blueprint $table) {
            $table->foreign(['id_tipo_proyecto'], 'fk_resi_proyecto_id_tipo_proyecto')->references(['id_tipo_proyecto'])->on('resi_tipo_proyecto')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resi_proyecto');
    }
};
