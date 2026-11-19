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
        Schema::create('respaldo_pdfs_danada_20260805', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_general_ci');

            $table->bigInteger('id', false, true)->default(0);
            $table->bigInteger('id_materia', false, true);
            $table->string('file_name', 255)->charset('latin1')->collation('latin1_swedish_ci');
            $table->string('file_path', 255)->charset('latin1')->collation('latin1_swedish_ci');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_grupo')->nullable();
            $table->integer('id_estado');
            $table->text('comentario')->charset('latin1')->collation('latin1_swedish_ci')->nullable();
            $table->integer('id_plan_encabezado')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('respaldo_pdfs_danada_20260805');
    }
};
