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
        Schema::create('inv_documentos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->bigInteger('id_documento', true, true);
            $table->integer('propietario_id', false, true)->nullable();
            $table->string('propietario_type', 255);
            $table->string('nombre', 255);
            $table->string('mime', 255)->nullable();
            $table->integer('size', false, true)->nullable();
            $table->string('extension', 10)->nullable();
            $table->string('ruta', 255)->nullable();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_documento']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inv_documentos');
    }
};
