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
        Schema::create('rm_resguardos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('utf8mb3');
            $table->collation('utf8mb3_unicode_ci');

            $table->bigInteger('id', true, true);
            $table->bigInteger('id_sector', false, true);
            $table->bigInteger('id_bienres', false, true);
            $table->date('fecha');
            $table->integer('stock1');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->primary(['id']);
            $table->index(['id_sector'], 'rm_resguardos_id_sector_foreign');
            $table->index(['id_bienres'], 'rm_resguardos_id_bienres_foreign');
        });

        Schema::table('rm_resguardos', function (Blueprint $table) {
            $table->foreign(['id_bienres'], 'fk_rm_resguardos_id_bienres')->references(['id'])->on('rm_bienes')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_sector'], 'fk_rm_resguardos_id_sector')->references(['id'])->on('rm_sectorauxs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rm_resguardos');
    }
};
