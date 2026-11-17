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
        Schema::create('pdfs', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id', true, true);
            $table->bigInteger('id_materia', false, true);
            $table->string('file_name', 255);
            $table->string('file_path', 255);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_grupo')->nullable();
            $table->integer('id_estado');
            $table->text('comentario')->nullable();
            $table->integer('id_plan_encabezado')->nullable();

            $table->primary(['id']);
        });

        Schema::table('pdfs', function (Blueprint $table) {
            $table->foreign(['id_grupo'], 'fk_pdfs_id_grupo')->references(['id_grupo'])->on('gnral_grupos')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pdfs');
    }
};
