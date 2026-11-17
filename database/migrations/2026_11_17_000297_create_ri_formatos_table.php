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
        Schema::create('ri_formatos', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_formato', true);
            $table->text('clave');
            $table->string('des_formato', 200)->nullable();
            $table->integer('id_sistema')->nullable();
            $table->text('url');
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->dateTime('created_at');

            $table->primary(['id_formato']);
        });

        Schema::table('ri_formatos', function (Blueprint $table) {
            $table->foreign(['id_sistema'], 'fk_ri_formatos_id_sistema')->references(['id_sistema'])->on('ri_sistema')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ri_formatos');
    }
};
