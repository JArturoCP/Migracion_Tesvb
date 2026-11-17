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
        Schema::create('gnral_municipios', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_municipio', true);
            $table->string('nombre_municipio', 50)->nullable();
            $table->integer('id_estado')->nullable();

            $table->primary(['id_municipio']);
        });

        Schema::table('gnral_municipios', function (Blueprint $table) {
            $table->foreign(['id_estado'], 'fk_gnral_municipios_id_estado')->references(['id_estado'])->on('gnral_estados')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gnral_municipios');
    }
};
