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
        Schema::create('inv_aspeval', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_aspeval', true, true);
            $table->bigInteger('id_aspecto', false, true);
            $table->bigInteger('id_valor', false, true);
            $table->text('comentario')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->bigInteger('id_evaluacion', false, true);

            $table->primary(['id_aspeval']);
        });

        Schema::table('inv_aspeval', function (Blueprint $table) {
            $table->foreign(['id_aspecto'], 'fk_inv_aspeval_id_aspecto')->references(['id_aspecto'])->on('inv_aspectos')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_evaluacion'], 'fk_inv_aspeval_id_evaluacion')->references(['id_evaluacion'])->on('inv_evaluaciones')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_valor'], 'fk_inv_aspeval_id_valor')->references(['id_valor'])->on('inv_valores')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_aspeval');
    }
};
