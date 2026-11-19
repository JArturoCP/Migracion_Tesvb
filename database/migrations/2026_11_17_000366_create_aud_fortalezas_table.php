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
        Schema::create('aud_fortalezas', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_fortaleza', true);
            $table->string('punto_proceso', 10)->nullable();
            $table->text('descripcion_f')->nullable();
            $table->integer('id_informe')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_fortaleza']);
        });

        Schema::table('aud_fortalezas', function (Blueprint $table) {
            $table->foreign(['id_informe'], 'fk_aud_fortalezas_id_informe')->references(['id_informe'])->on('aud_informe')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_fortalezas');
    }
};
