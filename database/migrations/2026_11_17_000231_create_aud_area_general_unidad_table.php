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
        Schema::create('aud_area_general_unidad', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_area_general_unidad', true);
            $table->integer('id_area_general')->default(0);
            $table->integer('id_unidad_admin')->nullable();
            $table->date('created_at');
            $table->date('updated_at');
            $table->date('deleted_at');

            $table->primary(['id_area_general_unidad']);
        });

        Schema::table('aud_area_general_unidad', function (Blueprint $table) {
            $table->foreign(['id_area_general'], 'fk_aud_area_general_unidad_id_area_general')->references(['id_area_general'])->on('aud_area_general')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aud_area_general_unidad');
    }
};
