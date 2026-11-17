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
        Schema::create('desarrollo_asigna_coordinador_general', function (Blueprint $table) {
            $table->engine('InnoDB');
            $table->charset('latin1');
            $table->collation('latin1_swedish_ci');

            $table->integer('id_asigna_coordinador_general', true);
            $table->integer('id_personal_asigna')->nullable();
            $table->integer('id_personal')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrentOnUpdate();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();

            $table->primary(['id_asigna_coordinador_general']);
        });

        // Tipos sin equivalente exacto en Schema Builder (ancho de despliegue, BIT, DOUBLE(M,D))
        DB::statement('ALTER TABLE `desarrollo_asigna_coordinador_general` MODIFY `id_asigna_coordinador_general` int(10) NOT NULL AUTO_INCREMENT');
        DB::statement('ALTER TABLE `desarrollo_asigna_coordinador_general` MODIFY `id_personal_asigna` int(10) DEFAULT NULL');
        DB::statement('ALTER TABLE `desarrollo_asigna_coordinador_general` MODIFY `id_personal` int(10) DEFAULT NULL');

        Schema::table('desarrollo_asigna_coordinador_general', function (Blueprint $table) {
            $table->foreign(['id_personal'], 'fk_desarrollo_asigna_coordinador_general_id_personal')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign(['id_personal_asigna'], 'fk_desarrollo_asigna_coordinador_general_id_personal_asigna')->references(['id_personal'])->on('gnral_personales')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desarrollo_asigna_coordinador_general');
    }
};
