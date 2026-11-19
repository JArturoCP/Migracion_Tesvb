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
        Schema::create('plan_res_diagnostico', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb4');
            $table->collation('utf8mb4_unicode_ci');

            $table->bigInteger('id', true, true);
            $table->bigInteger('id_temario', false, true);
            $table->string('grupo', 255);
            $table->text('descripcion');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->integer('id_encabezado')->nullable();

            $table->primary(['id']);
            $table->index(['id_temario'], 'id_temario');
        });

        Schema::table('plan_res_diagnostico', function (Blueprint $table) {
            $table->foreign(['id_temario'], 'plan_res_diagnostico_ibfk_1')->references(['id_temario'])->on('plan_temarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plan_res_diagnostico');
    }
};
