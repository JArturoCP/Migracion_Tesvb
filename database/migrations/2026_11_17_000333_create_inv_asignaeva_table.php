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
        Schema::create('inv_asignaeva', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_asignaeva', true, true);
            $table->integer('propietario_id', false, true)->nullable();
            $table->string('propietario_type', 255)->nullable();
            $table->bigInteger('id_investigador', false, true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asignaeva']);
        });

        Schema::table('inv_asignaeva', function (Blueprint $table) {
            $table->foreign(['id_investigador'], 'fk_inv_asignaeva_id_investigador')->references(['id_investigador'])->on('inv_investigadores')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_asignaeva');
    }
};
