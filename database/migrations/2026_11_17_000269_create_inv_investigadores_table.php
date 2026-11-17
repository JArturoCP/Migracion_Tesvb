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
        Schema::create('inv_investigadores', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_investigador', true, true);
            $table->integer('id_periodo');
            $table->bigInteger('id_usuario', false, true);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_investigador']);
        });

        Schema::table('inv_investigadores', function (Blueprint $table) {
            $table->foreign(['id_periodo'], 'fk_inv_investigadores_id_periodo')->references(['id_periodo'])->on('gnral_periodos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_investigadores');
    }
};
