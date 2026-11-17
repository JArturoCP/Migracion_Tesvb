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
        Schema::create('inv_categorias', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_categoria', true, true);
            $table->bigInteger('id_tipo', false, true);
            $table->string('descripcion', 250);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id_categoria']);
        });

        Schema::table('inv_categorias', function (Blueprint $table) {
            $table->foreign(['id_tipo'], 'fk_inv_categorias_id_tipo')->references(['id_tipo'])->on('inv_tipos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_categorias');
    }
};
