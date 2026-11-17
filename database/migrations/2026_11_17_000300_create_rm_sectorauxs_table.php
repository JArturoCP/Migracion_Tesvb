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
        Schema::create('rm_sectorauxs', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_unicode_ci');

            $table->bigInteger('id', true, true);
            $table->string('nombre', 255);
            $table->string('csp', 10);
            $table->string('puesto', 45);
            $table->date('fechain');
            $table->bigInteger('id_area');
            $table->boolean('condicion')->default(1);
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id']);
            $table->unique(['csp'], 'rm_sectorauxs_csp_unique');
            $table->index(['id_area'], 'id_area');
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `rm_sectorauxs` MODIFY `id_area` bigint(10) NOT NULL');

        Schema::table('rm_sectorauxs', function (Blueprint $table) {
            $table->foreign(['id_area'], 'id_area')->references(['id_unidad_admin'])->on('gnral_unidad_administrativa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rm_sectorauxs');
    }
};
